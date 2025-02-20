<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin();
    }

    public function rules(): array
    {
        return [
            'model' => 'required|string|max:255',
            'type' => 'required|in:car,scooter,bike',
            'battery_capacity' => 'required|integer|between:0,100',
            'status' => 'required|in:available,maintenance',
            'hourly_rate' => 'required|numeric|min:0'
        ];
    }
}
