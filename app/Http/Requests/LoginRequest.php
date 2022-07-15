<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    /**
     * エラー文
     *
     * @return void
     */
    public function messages()
    {
        return [
            'email.required'    => ':attributeは必須項目です。',
            'email.email'       => ':attributeの書式が正しくありません。',
            'password.required' => ':attributeは必須項目です。',
            'password.min'      => ':attributeは8文字以上で入力してください。',
        ];
    }

    /**
     * 項目名
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'email'    => 'Eメール',
            'password' => 'パスワード'
        ];
    }

    /**
     * バリデーション失敗時の挙動
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $response['data']    = [];
        $response['status']  = '422';
        $response['summary'] = 'Failed validation.';
        $response['errors']  = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json(['data' => $response], 422)
        );
    }
}
