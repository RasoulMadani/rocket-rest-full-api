<?php

namespace App\Http\ApiRequests\Admin\AccessLevel;

use App\Controlresponse\ApiFormRequest;

class AssingRolesToUserApiRequest extends ApiFormRequest
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
            'roles' => 'required|array',
            //در اینجا یک شرط برای تک تک اعضای پرمیزن قرار می دهیم تا حتما در جدول پرمیزن موجود باشند
            'roles.*' => 'exists:roles,id'
        ];
    }
}
