<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReservationRequest extends FormRequest
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
            'date' => 'required|after_or_equal:today|date_format:Y-m-d H:i',
            'number' => 'required',
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
            'date.required'          => ':attributeは必須項目です。',
            'date.after_or_equal'    => ':attributeは今日以降の日付にしてください。',
            'date.date_format'       => ':attributeの入力が正しくありません。',
            'number.required'        => ':attributeは必須項目です。',
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
            'date'     => '予約日時',
            'number'   => '人数'
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
