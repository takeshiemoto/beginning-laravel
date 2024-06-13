<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all(['id', 'title', 'description', 'completed']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean'
        ]);

        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed
        ]);

        return response()->json($todo, 201);
    }
}
