<?php

namespace App\Http\Requests\Frontend\User;

use App\Rules\Auth\ChangePassword;
use App\Rules\Auth\UnusedPassword;
use Illuminate\Foundation\Http\FormRequest;
use DivineOmega\LaravelPasswordExposedValidationRule\PasswordExposed;

/**
 * Class UpdatePasswordRequest.
 */
class UpdatePasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'password'     => [
                'required',
                'confirmed',
                new ChangePassword(),
                new PasswordExposed(),
                new UnusedPassword($this->user()),
            ],
        ];
    }
}
