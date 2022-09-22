<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
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
            "movie_id" => "required|integer",
            "studio_id" => "required|integer",
            "start_time" => "required|string",
            "end_time" => "required|string",
            "price" => "required|integer",
            "date" => "required",
        ];
    }
}
