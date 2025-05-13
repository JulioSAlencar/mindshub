<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function generate($disciplineId)
    {
        $user = Auth::user();

        // Verifica se o certificado já existe
        $certificate = Certificate::firstOrCreate(
            ['user_id' => $user->id, 'discipline_id' => $disciplineId],
            ['issued_at' => now()]
        );

        return redirect()->route('certificates.download', $certificate->id);
    }

    public function download($id)
    {
        $certificate = Certificate::with('user', 'discipline')->findOrFail($id);

        $pdf = Pdf::loadView('certificates.template', [
            'certificate' => $certificate
        ]);

        return $pdf->download("certificado-{$certificate->user->name}.pdf");
    }
}
