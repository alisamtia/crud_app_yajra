<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if(request()->routeIs("update")){
            return [
                "edit_name"=>'required|min:5|max:225',
                "edit_email"=>'required|email',
                "edit_password"=>'required|min:8|max:225'
            ];
        }
        elseif(request()->routeIs("create")){
            return [
                "create_name" => "required|min:3|max:225",
                "create_email" => "required|email|unique:users,email",
                "create_password" => "required|min:8|max:225",
            ];
        }
    }

}
