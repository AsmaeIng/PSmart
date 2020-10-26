<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('role_create');
    }

    public function rules()
    {
        return [
            'name'         => [
                'required',
            ],
			'slug' => [
                'required',
            ],
            'permissions.*' => [
                'integer',
            ],
            'permissions'   => [
                'required',
                'array',
            ],
        ];
    }
}