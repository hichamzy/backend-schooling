<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function index()
    {
        $students = QueryBuilder::for(Student::class)
        ->allowedFilters(['nom', 'prenom', 'code_cne', 'filier', 'annee'])
        ->get();
        return $students;
    }

    public function show($id)
    {
        return Student::find($id);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'code_cin' => 'required',
            'code_cne' => 'required',
            'gender' => 'required',
            'lieu_naissance' => 'required',
            'date_naissance' => 'required',
            'filier' => 'required',
            'annee' => 'required',
        ]);
        $student = Student::find($id);
        $student->nom = $request->nom;
        $student->prenom = $request->prenom;
        $student->email = $request->email;
        $student->code_cne = $request->code_cne;
        $student->code_cin = $request->code_cin;
        $student->gender = $request->gender;
        $student->lieu_naissance = $request->lieu_naissance;
        $student->date_naissance = $request->date_naissance;
        $student->filier = $request->filier;
        $student->annee = $request->annee;

        $student->save();
        return $student;
    }
    public function exportExcelList()
    {
        $students = QueryBuilder::for(Student::class)
        ->allowedFilters(['filier', 'annee'])
        ->get();
        $export = new StudentsExport($students);
        return Excel::download($export, 'list.xlsx');
        
    }

    public function exportPdf($id)
    {
        $std = Student::find($id);
        $pdf = PDF::loadView('pdf', compact("std"));
        return $pdf->download($std->nom . "-" . $std->prenom .'.pdf');
    }
}
