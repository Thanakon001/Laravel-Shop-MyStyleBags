<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
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
            'rating_point' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
            'pro_bacode' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'rating_point.required' => 'กรุณาให้คะแนนสินค้า',
            'rating_point.integer' => 'คะแนนต้องเป็นตัวเลขเท่านั้น',
            'rating_point.min' => 'คะแนนต้องมากกว่าหรือเท่ากับ 1',
            'rating_point.max' => 'คะแนนต้องน้อยกว่าหรือเท่ากับ 5',
            'pro_bacode.required' => 'กรุณากรอกรหัสสินค้า',
        ];
    }
}
