<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $student = Student::where([
            ['email', '=', $request->email],
            ['code_cin', '=', $request->password]
        ])->firstOrFail();

        return $student;
    }
}
