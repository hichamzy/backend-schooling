<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Module;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class MatiereController extends Controller
{
    public function filters()
    {
        $module = QueryBuilder::for(Module::class)
            ->allowedFilters(['filier', 'semestre'])
            ->with('matieres')
            ->first();
        return $module->matieres;
    }

    public function index()
    {
        return Matiere::with('module:id,module')->get();
    }

    public function show($id)
    {
        return Matiere::find($id);
    }

    public function insert(Request $request)
    {
        $matiere = new Matiere();
        $matiere->matiere = $request->matiere;
        $matiere->module_id = $request->module_id;
        $matiere->prof_id = $request->prof_id;
        $matiere->save();
        return Matiere::with('module:id,module')->find($matiere->id);
    }
    public function update(Request $request, $id)
    {
        $matiere = Matiere::find($id);
        $matiere->matiere = $request->matiere;
        $matiere->module_id = $request->module_id;
        $matiere->prof_id = $request->prof_id;
        $matiere->save();
        return Matiere::with('module:id,module')->find($matiere->id);
    }
    public function delete($id)
    {
        $matiere = Matiere::find($id);
        $matiere->delete();
    }
}
