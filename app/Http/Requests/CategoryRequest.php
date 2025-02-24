<?php

namespace App\Http\Requests;

use App\Models\Category;
use FFI\CType;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $id = $this->route('category');
        return Category::rules($id);
    }
    public function message()
    {
        return [
            'required' => 'هذا الحقل :attribute فارغ !',
            'unique' => 'هذا الحقل :attribute موجود بالفعل!'
        ];  
    }
}
