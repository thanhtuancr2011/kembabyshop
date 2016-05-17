<?php 

namespace App\Http\Controllers\Api\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Requests;
use App\Models\CategoryModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller 
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Create new category
	 * 
	 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
	 * 
	 * @param  CategoryFormRequest $request Form Request
	 * 
	 * @return Response
	 */
	public function store(CategoryFormRequest $request)
	{
		$status = 0;

		$data = $request->all();

		$categoryModel = new CategoryModel;

		$category = $categoryModel->createNewCategory($data);

		if ($category) {
			$status = 1;
		}

		return new JsonResponse(['status' => $status, 'category' => $category]);
	}

	/**
     * Create new image for category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Request $request Request
     * 
     * @return Int              Status true or false
     */
    public function createImageCategory($id, Request $request) 
    {
        $data = $request->all();

        $images = $data['fileUploaded'];

        $category = CategoryModel::findOrFail($id);

        $status = $category->createImageCategory($images);

        return new JsonResponse(['status' => $status, 'category' => $category]);
    }

	/**
	 * Edit category
	 *
	 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
	 * 
	 * @param  Int                 $id      Category id
	 * @param  CategoryFormRequest $request Form request
	 * 
	 * @return Response                       
	 */
	public function update($id, CategoryFormRequest $request)
	{
		$status = 0;

        $redirect = 0;

        $data = $request->all();

		$category = CategoryModel::findOrFail($id);

		$status = $category->updateCategory($data);
		
		return new JsonResponse(['status' => $status, 'category' => $category]);
	}

	/**
     * Remove the category from storage.
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 0;

        $categoryModel = new CategoryModel;

        $categoryModel->deleteCategory($id);

        return new JsonResponse(['status' => 1]);
    }
}
