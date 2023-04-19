<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResidenceFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'character_id' => ['required', 'exists:characters,id'],
            'quarter_id' => ['required', 'exists:quarters,id'],
            'user_id' => ['exists:users,id'],
            'title' => ['required', 'min:12'],
            'nb_small_journey' => ['required', 'integer', 'min:1'],
            'nb_long_journey' => ['required', 'integer', 'min:2'],
            'nb_persons' => ['required', 'integer', 'min:1'],
            'price_small_journey' => ['required', 'integer'],
            'price_long_journey' => ['required', 'integer'],
            'price_caution' => ['required', 'integer'],
            'sold'  => ['required', 'boolean'],
        ];
    }
}
