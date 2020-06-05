<?php

namespace App\Http\Requests;

use App\Personne;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PersonneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => ['required', 'min:3'],
            'lastname' => ['required', 'min:3'],
            'mobileno' => ['required', 'min:11','numeric'],
            'email' => ['required', 'email', Rule::unique((new Personne())->getTable())->ignore(auth()->id())],
            'password' => ['required', 'min:6'],
            'category_id ' => ['required','numeric'],
            'class_id' => ['required','numeric'],
            'is_active'=>['required','in:yes,no,Yes,No']
        ];
    }
}
