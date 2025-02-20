<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "pro_image" => "required",
            "pro_price" => "required",
            "pro_stock" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "pro_name" => 'กรุณากรอกชื่อสินค้า',
            "band_id" => 'กรุณาเลือกยี่ห้อ',
            "pro_details" => 'กรุณากรอกรายละเอียดสินค้า',
            "pro_image" => 'กรุณาเลือกรูปภาพ',
            "pro_price" => 'กรุณากรอกราคาสินค้า',
            "pro_stock" => 'กรุณากรอกจำนวนสินค้า',
        ];
    }
}
