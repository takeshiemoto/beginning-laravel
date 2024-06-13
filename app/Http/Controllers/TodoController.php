<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = [
            'id' => 1,
            'title' => 'Todo 1',
            'description' => 'Todo 1 description',
            'completed' => false,
        ];

        return response()->json($todos);
    }
}
