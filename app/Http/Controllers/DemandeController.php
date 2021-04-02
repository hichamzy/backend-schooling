<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index()
    {
        return Demande::select('id', 'student_id')->where([
            ['envoyee', '=', 1],
            ['accepte', '=', 0],
        ])->get()->transform(function ($demande) {
            return [
                'id' => $demande->id,
                'student' => $demande->student->nom . " " . $demande->student->prenom
            ];
        });
    }

    public function show($student_id)
    {
        return Demande::firstOrCreate(
            ['student_id' => $student_id],
            [
                'student_id' => $student_id,
                'fois' => 0,
                'accepte' => 0,
                'envoyee' => 0
            ]
        );
    }

    public function accepte(Demande $demande)
    {
        $demande->accepte = 1;
        $demande->fois += 1;
        $demande->save();
    }

    public function envoyee($id)
    {
        $demande = Demande::find($id);
        $demande->envoyee = 1;
        $demande->save();
        return $demande;
    }
}
