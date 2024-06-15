<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        $todos = Todo::all(['id', 'title', 'description', 'completed', 'created_at', 'updated_at']);

        return response()->json(TodoResource::collection($todos), Response::HTTP_OK);
    }

    public function store(StoreTodoRequest $request): JsonResponse
    {
        // バリデーション済みのデータを取得
        $todo = Todo::create($request->validated());

        return response()->json(new TodoResource($todo), Response::HTTP_CREATED);
    }

    public function update(UpdateTodoRequest $request, $id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->validated());

        return response()->json(new TodoResource($todo), Response::HTTP_OK);
    }

    public function show($id): JsonResponse
    {
        $todo = Todo::findOrFail($id);

        return response()->json(new TodoResource($todo), Response::HTTP_OK);
    }

    public function destroy($id): JsonResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
