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
        $discipline = Discipline::with('missions')->findOrFail($disciplineId);

        if (!$discipline->is_completed) {
            return back()->with('error', 'A disciplina ainda não foi concluída pelo professor.');
        }

        $allGrades = \DB::table('mission_user')
            ->join('missions', 'missions.id', '=', 'mission_user.mission_id')
            ->where('missions.discipline_id', $disciplineId)
            ->pluck('mission_user.grade');

        $userGrades = \DB::table('mission_user')
            ->join('missions', 'missions.id', '=', 'mission_user.mission_id')
            ->where('missions.discipline_id', $disciplineId)
            ->where('mission_user.user_id', $user->id)
            ->pluck('mission_user.grade');

        $mediaGeral = $allGrades->avg();
        $mediaAluno = $userGrades->avg();

        if ($mediaAluno < $mediaGeral) {
            return back()->with('error', 'Você não atingiu a média necessária para receber o certificado.');
        }

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
