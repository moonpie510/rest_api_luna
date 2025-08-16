<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CoordinateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lat_min' => ['required', 'numeric', 'min:-90', 'max:90'],
            'lat_max' => ['required', 'numeric', 'min:-90', 'max:90'],
            'lng_min' => ['required', 'numeric', 'min:-180', 'max:180'],
            'lng_max' => ['required', 'numeric', 'min:-180', 'max:180'],
        ];
    }

    public function messages(): array
    {
        return [
            'lat_min.required' => 'Введите минимальную широту',
            'lat_max.required' => 'Введите максимальную широту',
            'lng_min.required' => 'Введите минимальную долготу',
            'lng_max.required' => 'Введите максимальную долготу',

            'lat_min.numeric' => 'Минимальная широта должна быть числом',
            'lat_max.numeric' => 'Максимальная широта должна быть числом',
            'lat_min.min' => 'Минимальная широта должна быть больше -90',
            'lat_max.max' => 'Максимальная широта должна быть меньше 90',

            'lng_min.numeric' => 'Минимальная долгота должна быть числом',
            'lng_max.numeric' => 'Максимальная долгота должна быть числом',
            'lng_min.min' => 'Минимальная долгота должна быть больше -180',
            'lng_max.max' => 'Максимальная долгота должна быть меньше 180',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::error(errors: $validator->errors()->toArray()));
    }
}
