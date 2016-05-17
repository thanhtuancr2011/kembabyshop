<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\UserModel;

class UserFormRequest extends FormRequest{
	protected $rules = [
		'first_name' => 'required',
		'last_name'  => 'required',
		'email' 	 => 'required|unique:users,email',
		'password' 	 => 'required'
	];

	public function rules()
    {
        $rules = $this->rules;

        /* Get all data input */
        $data  = $this->all();

        /* If update user */
        if (!empty($data['id'])){

        	/* Find user */
        	$user = UserModel::findOrFail($data['id']);

        	/* If email input = email of user edit */
        	if($user->email == $data['email']){
        		$rules = [
					'email'=>'required|unique:users,email,null,id,email,!='.$user->email
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
            'email.unique' => 'Email này đã tồn tại',
            'first_name.required' => 'Nhập họ của bạn',
            'last_name.required' => 'Nhập tên của bạn',
            'email.required' => 'Mời bạn nhập Email',
            'password.required' => 'Bạn chưa nhập Password'
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