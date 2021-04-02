<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Student;
use App\Exports\NotesExport;
use App\Imports\NotesImport;
use App\Models\Note;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NoteController extends Controller
{
    public function exportList($filier, $annee, $matiere_id)
    {
        $matiere = Matiere::find($matiere_id);
        $students = Student::where([
            ['filier', '=', $filier],
            ['annee', '=', $annee]
        ])->get();

        $export = new NotesExport($students, $matiere);
        return Excel::download($export, 'notes_de_'. $matiere->matiere .'.xlsx');
    }

    public function importList(Request $request)
    {
        $data = Excel::toArray(new NotesImport, $request->file('file'));
        $matiere_id = $data[0][0][3];
        Note::where('matiere_id', $matiere_id)->delete();
        $rows = array_slice($data[0], 2);
        foreach ($rows as $row) {
            $note = new Note();
            $note->student_id = $row[0];
            $note->matiere_id = $matiere_id;
            $note->controle = floatval($row[4]);
            $note->exame = floatval($row[5]);
            $note->save();
        }
        return ['message' => 'Notes importées avec succès'];
    }

    public function studentNote($id)
    {
        $notes = Note::where('student_id', $id)->get();
        $semestres = $notes->transform(function($note) {
            return [
                'id' => $note->id,
                "controle" => $note->controle,
                "exame" => $note->exame,
                "moyenne" => round(($note->controle * 0.4) + ($note->exame * 0.6), 2),
                "matiere" => $note->matiere->matiere,
                "module" => $note->matiere->module->module,
                "semestre" => $note->matiere->module->semestre,
            ];
        }) ;

        
        return $semestres;
    }
}
