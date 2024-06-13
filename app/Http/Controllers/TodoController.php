<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return Todo::all(['id', 'title', 'description', 'completed']);
    }

    public function store(StoreTodoRequest $request)
    {
        // バリデーション済みのデータを取得
        $todo = Todo::create($request->validated());

        return response()->json($todo, 201);
    }

    public function update(UpdateTodoRequest $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->validated());

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
