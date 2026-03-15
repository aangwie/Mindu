<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class UpdateSettingsController extends Controller
{
    public function index()
    {
        $githubToken = Setting::get('github_token');
        return view('admin.update-settings', compact('githubToken'));
    }

    public function updateToken(Request $request)
    {
        $request->validate([
            'github_token' => ['required', 'string', 'regex:/^github_pat_[a-zA-Z0-9_]+$/'],
        ], [
            'github_token.regex' => 'Format token harus github_pat_xxxx (boleh menyertakan angka, huruf, dan underscore)',
        ]);

        Setting::set('github_token', $request->github_token);

        return back()->with('success', 'Token GitHub berhasil disimpan.');
    }

    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            return response()->json(['status' => 'success', 'message' => 'Cache berhasil dibersihkan.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function clearConfig()
    {
        try {
            Artisan::call('config:clear');
            return response()->json(['status' => 'success', 'message' => 'Konfigurasi berhasil dibersihkan.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function runUpdate()
    {
        $token = Setting::get('github_token');

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'output' => "Error: GitHub Token belum diatur.\nSilakan simpan token terlebih dahulu.\n",
            ]);
        }

        $output = "";
        $basePath = base_path();

        try {
            // Step 1: Get current remote URL
            $output .= "Checking for updates...\n";
            $remoteResult = $this->runShell('git remote get-url origin', $basePath);
            $remoteUrl = trim($remoteResult['output']);
            $output .= "Remote: {$remoteUrl}\n";

            // Step 2: Set authenticated remote URL for fetch
            // Convert https://github.com/user/repo.git → https://<token>@github.com/user/repo.git
            $authUrl = preg_replace(
                '#https://(.*@)?github\.com/#',
                "https://{$token}@github.com/",
                $remoteUrl
            );

            $output .= "Setting authenticated remote...\n";
            $this->runShell("git remote set-url origin \"{$authUrl}\"", $basePath);

            // Step 3: Fetch latest from origin
            $output .= "Fetching from origin...\n";
            $fetchResult = $this->runShell('git fetch origin main 2>&1', $basePath);
            $output .= $fetchResult['output'] ?: "Fetch completed.\n";

            // Step 4: Check if there are changes
            $diffResult = $this->runShell('git diff HEAD origin/main --stat 2>&1', $basePath);
            $diffOutput = trim($diffResult['output']);

            if (empty($diffOutput)) {
                $output .= "Already up to date. Tidak ada perubahan baru.\n";
            } else {
                $output .= "Perubahan ditemukan:\n{$diffOutput}\n\n";

                // Step 5: Force reset to match remote
                $output .= "Applying updates (git reset --hard origin/main)...\n";
                $resetResult = $this->runShell('git reset --hard origin/main 2>&1', $basePath);
                $output .= $resetResult['output'] . "\n";

                // Step 6: Post-update tasks
                $output .= "Running post-update tasks...\n";

                // Composer install (if composer.json changed)
                $output .= "  > composer install --no-dev --optimize-autoloader...\n";
                $composerResult = $this->runShell('composer install --no-dev --optimize-autoloader --no-interaction 2>&1', $basePath);
                $output .= $composerResult['output'] . "\n";

                // Run migrations
                $output .= "  > php artisan migrate --force...\n";
                try {
                    Artisan::call('migrate', ['--force' => true]);
                    $output .= Artisan::output();
                } catch (\Exception $e) {
                    $output .= "  Migration warning: " . $e->getMessage() . "\n";
                }

                // Clear caches
                $output .= "  > Clearing caches...\n";
                Artisan::call('config:clear');
                Artisan::call('cache:clear');
                Artisan::call('view:clear');
                Artisan::call('route:clear');
                $output .= "  Cache cleared.\n";

                $output .= "\n✅ Update berhasil diterapkan!\n";
            }

            // Step 7: Restore original remote URL (without token)
            $this->runShell("git remote set-url origin \"{$remoteUrl}\"", $basePath);

            return response()->json(['status' => 'success', 'output' => $output]);

        } catch (\Exception $e) {
            // Always restore original remote URL on error
            if (isset($remoteUrl)) {
                $this->runShell("git remote set-url origin \"{$remoteUrl}\"", $basePath);
            }

            Log::error('GitHub Update Error: ' . $e->getMessage());
            $output .= "\n❌ Error: " . $e->getMessage() . "\n";
            return response()->json(['status' => 'error', 'output' => $output]);
        }
    }

    /**
     * Run a shell command and return its output and exit code.
     */
    private function runShell(string $command, string $cwd): array
    {
        $process = proc_open($command, [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ], $pipes, $cwd);

        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        $exitCode = proc_close($process);

        return [
            'output' => $stdout ?: $stderr,
            'exitCode' => $exitCode,
        ];
    }
}
