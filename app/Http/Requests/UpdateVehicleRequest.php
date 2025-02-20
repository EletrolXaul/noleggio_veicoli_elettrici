<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'model' => 'required|string|max:255',
            'type' => 'required|in:car,scooter,bike',
            'battery_capacity' => 'required|integer|between:0,100',
            'status' => 'required|in:available,rented,maintenance',
            'hourly_rate' => 'required|numeric|min:0'
        ];
    }
}
