<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $fillable = ['name', 'email','username', 'tel', 'cin', 'cnss', 'adress_id', 'laguage','path', 'skype', 'verified'];

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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
        ];
    }
}
