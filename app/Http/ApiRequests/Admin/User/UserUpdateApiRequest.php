<?php

namespace App\Http\ApiRequests\Admin\User;

use App\Controlresponse\ApiFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserUpdateApiRequest extends ApiFormRequest
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
        return User::rules([
            // در اینجا می گوییم که برای به روزرسانی یکتا بودن کاربر فعلی رو بررسی نکن
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => ['nullable', 'string', 'min:8', 'max:255'],
        ]);
    }
}
