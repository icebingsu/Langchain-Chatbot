<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class TickersRequest extends FormRequest
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
            "limit" => "nullable|integer|min:1",
            "offset" => "nullable|integer|min:1",
            "sortOn" =>
                "nullable|string|in:marketcap,price,dailyDelta,weeklyDelta,yearlyDelta,pe,pb,roe,exchange,industry",
            "sortOrder" => "nullable|string|in:asc,desc",
        ];
    }
}
