<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\CategoryModel;

class CategoryFormRequest extends FormRequest
{
    protected $rules = [
        'name' => 'required',
        'alias' => 'unique:categories,alias'
    ];
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
        $rules = $this->rules;

        $data = $this->all();
        
        if (!empty($data['id']))
        {
            $category = CategoryModel::find($data['id']);
            if($category->alias == $data['alias']) {
                $rules = ['name' =>'required']; 
            } 
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống.',
            'alias.unique' => 'Tên danh mục đã tồn tại trong hệ thống.'
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['status' => 0, 'errors' => $errors]);
    }
}
