<x-admin-layout>
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Update</h2>
            <p class="text-slate-500 dark:text-slate-400">Kelola token GitHub dan pembersihan cache sistem.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- GitHub Token Form -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-700 dark:text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.43.372.823 1.102.823 2.222 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        GitHub Personal Access Token
                    </h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.update-settings.token') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="github_token" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">GitHub Personal Access Token (PAT)</label>
                                <div class="relative" x-data="{ show: false }">
                                    <input :type="show ? 'text' : 'password'" name="github_token" id="github_token" value="{{ $githubToken }}" placeholder="github_pat_xxxxxxxxxxxxxxxxxxx" 
                                           class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white pr-10 @error('github_token') border-red-500 ring-1 ring-red-500 @enderror">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                                        <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.053 0 2.062.18 3 .512M7.943 7.943L16.057 16.057M10.788 10.788L13.212 13.212M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path></svg>
                                    </button>
                                </div>
                                @error('github_token')
                                    <p class="mt-2 text-xs text-red-500 italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition shadow-sm">
                                Simpan Token
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- System Tools -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-slate-700 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        System Tools
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="clearCache()" id="btn-clear-cache" class="flex-1 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-xl transition shadow-sm flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Clear Cache
                        </button>
                        <button onclick="clearConfig()" id="btn-clear-config" class="flex-1 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl transition shadow-sm flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Clear Config
                        </button>
                    </div>
                    <button onclick="runUpdate()" id="btn-run-update" class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl transition shadow-lg flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Update from GitHub
                    </button>
                </div>
            </div>
        </div>

        <!-- Terminal Output -->
        <div class="bg-slate-900 rounded-2xl shadow-xl overflow-hidden border border-slate-800">
            <div class="px-4 py-2 bg-slate-800 flex items-center justify-between border-b border-slate-700">
                <div class="flex space-x-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
                <div class="text-xs text-slate-400 font-mono">terminal - git-bash</div>
                <div class="w-12"></div>
            </div>
            <div id="terminal" class="p-6 font-mono text-sm text-green-400 h-64 overflow-y-auto bg-black/50">
                <p>> System ready...</p>
                @if($githubToken)
                    <p class="text-slate-400">> GitHub Token detected.</p>
                @else
                    <p class="text-amber-400">> Warning: No GitHub Token found.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function logToTerminal(message, type = 'info') {
            const terminal = document.getElementById('terminal');
            const p = document.createElement('p');
            const now = new Date().toLocaleTimeString();
            
            let colorClass = 'text-green-400';
            if (type === 'error') colorClass = 'text-red-400';
            if (type === 'warning') colorClass = 'text-amber-400';
            if (type === 'system') colorClass = 'text-blue-400';
            
            p.className = colorClass;
            p.innerHTML = `<span class="text-slate-500">[${now}]</span> > ${message}`;
            terminal.appendChild(p);
            terminal.scrollTop = terminal.scrollHeight;
        }

        async function clearCache() {
            const btn = document.getElementById('btn-clear-cache');
            btn.disabled = true;
            btn.innerHTML = 'Cleaning...';
            logToTerminal('Clearing application cache...', 'system');
            
            try {
                const response = await fetch('{{ route('admin.update-settings.clear-cache') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const data = await response.json();
                logToTerminal(data.message, data.status === 'success' ? 'info' : 'error');
            } catch (e) {
                logToTerminal('Error: ' + e.message, 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Clear Cache';
            }
        }

        async function clearConfig() {
            const btn = document.getElementById('btn-clear-config');
            btn.disabled = true;
            btn.innerHTML = 'Cleaning...';
            logToTerminal('Clearing configuration cache...', 'system');
            
            try {
                const response = await fetch('{{ route('admin.update-settings.clear-config') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const data = await response.json();
                logToTerminal(data.message, data.status === 'success' ? 'info' : 'error');
            } catch (e) {
                logToTerminal('Error: ' + e.message, 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg> Clear Config';
            }
        }

        async function runUpdate() {
            const btn = document.getElementById('btn-run-update');
            btn.disabled = true;
            btn.innerHTML = 'Updating...';
            logToTerminal('Starting update from GitHub...', 'system');
            
            try {
                const response = await fetch('{{ route('admin.update-settings.run') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const data = await response.json();
                if (data.output) {
                    const lines = data.output.split('\n');
                    lines.forEach(line => {
                        if (line.trim()) logToTerminal(line);
                    });
                }
                logToTerminal('Update process finished.', 'info');
            } catch (e) {
                logToTerminal('Error: ' + e.message, 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg> Update from GitHub';
            }
        }
    </script>
</x-admin-layout>
