<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return
            [
                "email" => "required|email|string|max:255",
                "password" => "required|string|min:6"
            ];
    }

    public function messages(){
        return [
            "email.required" => "กรุณากรอก Email",
            "email.email" => "Email ไม่ถูกต้อง",
            "email.string" => "Email ต้องเป็นข้อความ",
            "email.max" => "Email ต้องมีความยาวไม่เกิน 255 ตัวอักษร",
            "password.required" => "กรุณากรอก Password",
            "password.string" => "Password ต้องเป็นข้อความ",
            "password.min" => "Password ต้องมีความยาวอย่างน้อย 6 ตัวอักษร"
        ];
    }
}
