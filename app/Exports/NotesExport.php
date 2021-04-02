<?php

namespace App\Exports;

use App\Models\Note;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NotesExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($list, $matiere) {
        $this->list = $list;
        $this->matiere = $matiere;
    }

    public function collection()
    {
        return $this->list;
    }

    public function headings(): array
    {
        return [
            ["Matiere", $this->matiere->matiere, "id matiere", $this->matiere->id],
            ["id", "Code cne", "Nom", "Sexe", "Note controle", "Note exame"]
        ];
    }

    public function map($student): array
    {
        $note = Note::where('student_id', $student->id)
                    ->where('matiere_id', $this->matiere->id)
                    ->first();

        return [
            $student->id,
            $student->code_cne,
            "$student->nom $student->prenom",
            $student->gender,
            $note->controle ?? null,
            $note->exame ?? null,
        ];
    }
}
