<?php

namespace App\Imports;

use App\Model\Note;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NotesImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        return $rows;
    }
}
