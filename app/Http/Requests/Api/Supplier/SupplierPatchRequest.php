<?php

namespace App\Http\Requests\Api\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierPatchRequest extends FormRequest
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


        // id supplier
        $id = $this->supplier;

        return [
            'name' => ['required', "unique:suppliers,name,$id"],
            'phone' => ['required', "unique:suppliers,phone,$id", 'min:10', 'max:20', 'string']
        ];
    }
}
