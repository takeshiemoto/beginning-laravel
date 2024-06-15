<?php

namespace App\Http\Requests;

class StoreTodoRequest extends BaseFormRequest
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
}
