<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ChatroomCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'max_members' => 'required|integer|min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The chatroom name is required.',
            'name.string' => 'The chatroom name must be a string.',
            'name.max' => 'The chatroom name may not be greater than 255 characters.',
            'max_members.required' => 'The maximum number of members is required.',
            'max_members.integer' => 'The maximum number of members must be an integer.',
            'max_members.min' => 'The maximum number of members must be at least 2.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
