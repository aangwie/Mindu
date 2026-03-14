<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TestResult;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TestResultController extends Controller
{
    public function download(TestResult $result)
    {
        // Enforce security
        if (auth()->id() !== $result->testSession->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $user = $result->testSession->user;
        $logo = Setting::get('site_logo');
        $address = Setting::get('site_address', 'Alamat belum diatur di pengaturan.');

        $pdf = Pdf::loadView('pdf.result', [
            'result' => $result,
            'user' => $user,
            'logo' => $logo,
            'address' => $address,
        ]);

        return $pdf->download("Hasil_Psikotest_{$user->full_name}.pdf");
    }
}
