<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|'
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
            'name.required'     => ':attributeは必須項目です。',
            'name.max'          => ':attributeは191文字以下で登録してください。。',
            'email.required'    => ':attributeは必須項目です。',
            'email.email'       => ':attributeの書式が正しくありません。',
            'email.unique'      => ':attributeは既に登録されています。',
            'password.required' => ':attributeは必須項目です。',
            'password.min'      => ':attributeは8文字以上で登録してください。',
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
            'name'     => '名前',
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
