<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\CustomerModel;

class CustomerFormRequest extends FormRequest{
	protected $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required|unique:customers,email',
		'address' => 'required',
		'phone' => 'required',
		'password' => 'required',
	];

	public function rules()
    {
        $rules = $this->rules;

        /* Get all data input */
        $data  = $this->all();

        /* If update customer */
        if (!empty($data['id'])){

        	/* Find customer */
        	$customer = CustomerModel::findOrFail($data['id']);

        	/* If email input = email of customer edit */
        	if($customer->email == $data['email']){
        		$rules = [
					'email'=>'required|unique:customers,email,null,id,email,!='.$customer->email
				];
        	}
        }
        return $rules;
    }

	public function authorize()
	{
		return true;
	}

	public function messages()
    {
        return [
            'email.unique' => 'Email này đã tồn tại trong hệ thống.'
        ];
    }

	/**
	 * Get the proper failed validation response for the request.
	 *
	 * @param  array  $errors
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function response(array $errors)
	{
		return new JsonResponse(['status'=>0, 'error'=>$errors]);
	}
}