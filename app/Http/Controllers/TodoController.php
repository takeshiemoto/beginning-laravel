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

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean'
        ]);

        $todo = Todo::findOrFail($id);

        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->completed = $request->completed;
        $todo->save();

        return response()->json($todo);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return response()->json($todo);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json(null);
    }
}
