<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($list) {
        $this->list = $list;
    }
    public function collection()
    {
        return $this->list;
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->code_cne,
            $student->code_cin,
            "$student->nom $student->prenom",
            $student->gender,
            $student->date_naissance,
            $student->lieu_naissance,
            $student->filier,
            $student->annee,
        ];
    }
    public function headings(): array
    {
        return [
            'id', "Code CNE", "Code CIN", "Nom et Prenom", 
            "Sexe", "Date naissance", "Lieu naissance", "Filier", "annee"
        ];
    }
}
