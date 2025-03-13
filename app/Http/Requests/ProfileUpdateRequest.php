<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'alamat' => ['string', 'min:5', 'regex:/^[A-Za-z0-9\s,\/\.\-#\(\):]+$/'],
            'no_hp' => ['string', 'min:10','max:12', 'regex:/^[0-9\-]+$/'],
            'nik' => ['string', 'size:16', 'regex:/^[0-9]+$/'],
            'profile' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'ktp' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
    }
}
