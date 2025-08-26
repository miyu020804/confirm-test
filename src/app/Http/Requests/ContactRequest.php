<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'family_name' =>
            ['required', 'string', 'max:50'],
            'given_name' =>
            ['required', 'string', 'max:50'],
            'gender' =>
            ['required', 'in:1,2,3'],
            'email' =>
            ['required', 'email'],
            'tel' =>
            ['required', 'digits_between:10,11'],
            'address' =>
            ['required', 'string', 'max:255'],
            'building' =>
            ['nullable', 'string', 'max:255'],
            'category_id' =>
            ['required', 'exists:categories,id'],
            'detail' =>
            ['required', 'string', 'max:120'],
        ];
    }

    public function attributes(): array
    {
        return [
            'family_name' => '姓',
            'given_name' => '名',
            'gender' => '性別',
            'email' => 'メールアドレス',
            'tel' => '電話番号',
            'address' => '住所',
            'building' => '建物名',
            'category_id' => 'お問い合わせの種類',
            'detail' => 'お問い合わせ内容'
        ];
    }

    public function messages(): array
    {
        return [
            'family_name.required' => '姓を入力してください',
            'given_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel.required' => '電話番号を入力してください',
            'tel.regex' => '電話番号は10~11桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせの内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
