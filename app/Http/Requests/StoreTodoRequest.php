<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class StoreTodoRequest extends FormRequest
{
    /**
     * ユーザーがこのリクエストを行う権限を持っているかどうかを確認します
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リクエストに適用される検証ルールを取得します。
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], Response::HTTP_BAD_REQUEST));
    }
}
