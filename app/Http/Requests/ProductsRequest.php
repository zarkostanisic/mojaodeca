<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            "name"=>"required|max:50",
            "phone"=>"required",
            "used"=>"boolean",
            "category_id"=>"required|integer",
            "subcategory_id"=>"integer",
            "gender_id"=>"required|integer",
            "images"=>"required|array|distinct",
        ];
    }

    public function messages()
    {
        return [
            'images.required' => 'Potrebno je uneti najmanje jednu sliku.',
        ];
    }
}
