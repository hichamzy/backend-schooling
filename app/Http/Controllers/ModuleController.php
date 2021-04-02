<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        return Module::all();
    }
    public function show($id)
    {
        return Module::find($id);
    }
    public function insert(Request $request)
    {
        $request->validate([
            "module" => "required",
            "filier" => "required",
            "semestre" => "required",
        ]);
        
        $module = new Module();
        $module->module = $request->module;
        $module->filier = $request->filier;
        $module->semestre = $request->semestre;
        $module->save();
        return $module;
    }
    public function update($id, Request $request)
    {
        $module = Module::find($id);
        $module->module = $request->module;
        $module->filier = $request->filier;
        $module->semestre = $request->semestre;
        $module->save();
        return $module;
    }
    public function delete($id)
    {
        $module = Module::find($id);
        $module->delete();
    }
}
