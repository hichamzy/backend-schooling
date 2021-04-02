<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use Illuminate\Http\Request;

class ProfController extends Controller
{
    public function index()
    {
        return Prof::all();
    }
    public function show($id)
    {
        return Prof::find($id);
    }
    public function insert(Request $request)
    {
        $prof = new Prof();
        $prof->nom = $request->nom;
        $prof->prenom = $request->prenom;
        $prof->code_cin = $request->code_cin;
        $prof->email = $request->email;
        $prof->save();
        return $prof;
    }
    public function update($id, Request $request)
    {
        $prof = Prof::find($id);
        $prof->nom = $request->nom;
        $prof->prenom = $request->prenom;
        $prof->code_cin = $request->code_cin;
        $prof->email = $request->email;
        $prof->save();
        return $prof;
    }
    public function delete($id)
    {
        $prof = Prof::find($id);
        $prof->delete();
    }
}
