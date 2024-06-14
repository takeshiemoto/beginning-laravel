<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        $todos =  Todo::all(['id', 'title', 'description', 'completed']);

        return response()->json($todos);
    }

    public function store(StoreTodoRequest $request): JsonResponse
    {
        // バリデーション済みのデータを取得
        $todo = Todo::create($request->validated());

        return response()->json($todo, 201);
    }

    public function update(UpdateTodoRequest $request, $id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->validated());

        return response()->json($todo);
    }

    public function show($id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        return response()->json($todo);
    }

    public function destroy($id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json(null);
    }
}
