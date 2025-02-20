<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        return [
            "pro_name" => "required",
            "band_id" => "required",
            "pro_details" => "required",
            "pro_price" => "required",
            "pro_stock" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "pro_name.required" => "กรุณากรอกชื่อสินค้า",
            "band_id.required" => "กรุณาเลือกยี่ห้อสินค้า",
            "pro_details.required" => "กรุณากรอกรายละเอียดสินค้า",
            "pro_price.required" => "กรุณากรอกราคาสินค้า",
            "pro_stock.required" => "กรุณากรอกจำนวนสินค้า",
        ];
    }
}
