<?php 
namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Models\ImageModel;
use App\Models\ProductModel;
use App\Services\FileService;

class CategoryModel extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'alias', 'sort_order', 'parent_id', 'keywords', 'description'];

    /**
     * Relationship category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Voids 
     */
    public function childrenCategories()
    {
        return $this->hasMany('App\Models\CategoryModel', 'parent_id');
    }

    /**
     * Relationship product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Voids 
     */
    public function products()
    {
        return $this->hasMany('App\Models\ProductModel', 'category_id');
    }

    /**
     * Relationship with images
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Voids 
     */
    public function images()
    {
        return $this->morphMany('App\Models\ImageModel', 'imageable');
    }

    /**
     * Get categories with format tree
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  integer $parent_id Id parent of category
     * 
     * @return Array              Hierachy categories
     */
    public function getCategoriesTree ($parent_id = 0)
    {
    	$categories = self::orderBy('sort_order', 'asc')->get()->toArray();

        // Array contain array categories reference
        $referenceCategories = [];
        foreach ($categories as &$category) {
            $category['subFolder'] = [];

            // Ancestor_ids of category
            $ancestor_ids = [];
            $this->getAncestorCategoryIds($category, $ancestor_ids);
            $category['ancestor_ids'] = $ancestor_ids;

            $referenceCategories[$category['id']] = $category;
        }

        // Put a folder to property subFolder of a parent folder that it should belong to
        foreach ($categories as &$category) {
            if(!empty($category['parent_id'])){
                $referenceCategories[$category['parent_id']]['subFolder'][] = &$referenceCategories[$category['id']];
            }
        }

        // Get root folders
        $hierachyCategories = $referenceCategories;
        foreach($hierachyCategories as $key => $hierachyCategory){
            if(!empty($hierachyCategory['parent_id']) && ($hierachyCategory['parent_id']!= '0')){
                unset($hierachyCategories[$key]);
            }
        }
        
        return array_values($hierachyCategories);
    }

    /**
     * Get all ancestor ids of category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Object $category      Category
     * @param  Array  &$ancestor_ids Array ancestor ids
     * 
     * @return Void                
     */
    public function getAncestorCategoryIds($category, &$ancestor_ids) 
    {
    	$ancestor_ids[] = $category['parent_id'];
        // If category has parent
    	if ($category['parent_id'] != 0) {
    		$cat = self::find($category['parent_id'])->toArray();
    		self::getAncestorCategoryIds($cat, $ancestor_ids);
    	}
    }

    /**
     * Create new category
     *
     * @author Thanh Tuan <thanhtuan@cr2011@gmail.com>
     * 
     * @param  Array $data Data input
     * 
     * @return Array       Status
     */
    public function createNewCategory($data)
    {   
        // Set parent_id if data input not has
        if (!isset($data['parent_id'])) {
            $rootCategory = self::where('parent_id', 0)->first();
            $data['parent_id'] = $rootCategory->id;
        }

        // Set alias
        $data['alias'] = str_slug($data['name'], '_');

        // Set keywords
        $data['keywords'] = str_slug($data['name'], '-');

        $category = self::create($data);

        return $category;
    }

    /**
     * Create new images for category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Array $images Images
     * 
     * @return Int           Status true or false
     */
    public function createImageCategory ($images) 
    {
        $status = 0;

        foreach ($images as $key => &$image) {
            $status = $this->images()->create($image);
        }

        return $status;
    }

    /**
     * Update category
     *
     * @author Thanh Tuan <thanhtuan@cr2011@gmail.com>
     * 
     * @param  Array $data Data input
     * 
     * @return Array       Status
     */
    public function updateCategory($data)
    {   
        $categoryImage = new ImageModel;

        if (isset($data['fileUploaded']) && count($data['fileUploaded']) > 0) {

            // File uploaded
            $filesUpload = $data['fileUploaded'];

            // Contain all uniIds of files uploaded
            $uniIdsFile = array_pluck($filesUpload, 'uniId');

            // Get all images of product
            $images = $this->images->toArray();
            
            // Contain all uniIds of product images
            $uniIdsCategory = array_pluck($images, 'uniId');

            $uniIdsDelete = array_diff($uniIdsCategory, $uniIdsFile);

            $imagesDelete = $categoryImage->whereIn('uniId', $uniIdsDelete)->get();
            
            // Delete file images
            $this->deleteFileImagesCategory($imagesDelete);

            // Delete all images of product
            $this->images()->delete();

            foreach ($filesUpload as $key => $file) {
                $this->images()->create($file);
            }
        }        

        // Set parent_id if data input not has
        if (!isset($data['parent_id'])) {
            $data['parent_id'] = 0;

        // If user choose parent category it self
        } elseif ($data['parent_id'] == $this->id) {
            $data['parent_id'] = $this->parent_id;
        }

        // Set alias
        $data['alias'] = str_slug($data['name'], '_');

        // Set keywords
        $data['keywords'] = str_slug($data['keywords'], '-');

        $status = $this->update($data);

        return $status;
    }

    /**
     * Delete images category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Array $imagesDelete Array images
     * 
     * @return Void               
     */
    public function deleteFileImagesCategory($imagesDelete) 
    {
        $fileService = new FileService;

        $storeDisk = 'local_category';

        // Each image want delete
        foreach ($imagesDelete as $key => $imageDelete) {
            // Folder contain image
            $folderName = $imageDelete->folder;
            // Folder delete
            $folderNameDelete = explode('/', $folderName);
            // Delete folder
            $fileService->delete($folderNameDelete[0], $storeDisk);
        }
    }

    /**
     * Delete category and all child category of category want delete
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Int $id Category id
     * 
     * @return Void     
     */
    public function deleteCategory($id)
    {
        // Find Category
        $category = self::find($id);

        // Find all child
        $childrenCategories = $category->childrenCategories;

        // If category has child
        if (!empty($childrenCategories)) {
            // Each child
            foreach ($childrenCategories as $childrenCategory) {
                // Call function delete category
                $this->deleteCategory($childrenCategory->id);
            }
        }

        $imagesDelete = $category->images;

        // Delete file images
        $this->deleteFileImagesCategory($imagesDelete);

        $category->images()->delete();

        // Products of category
        $products = $category->products;

        // Each product -> call function delete product
        foreach ($products as $product) {
            $product->deleteProduct();
        }

        $category->delete();
    }

    /**
     * Upload image category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  File $files File
     * 
     * @return Array       File stored
     */
    public function uploadFiles($files)
    {
        // If not exists files
        if(empty($files) || !$files['tmp_name']){
            return ['status' => 0, 'message' => 'upload fail'];
        }

        $ext = pathinfo($files['name'], PATHINFO_EXTENSION);                // File extension
        $fileName = pathinfo($files['name'], PATHINFO_FILENAME);            // File name
        $hash = substr(explode('/',md5(uniqid().time()))[0], 0 ,10);        // Hash to create file name store and folder
        $stored_file_name = strtolower($fileName .'_'. $hash . '.' . $ext); // File name store

        // Disk to store file
        $storeDisk = 'local_category';                                   

        // Init file service to call function in it
        $fileService = new FileService;

        $folder = substr($hash , 0 ,2) .'/'. substr($hash , 2 ,2) .'/'; 

        try {
            $status = $fileService->save($stored_file_name, file_get_contents($files['tmp_name']), false, $folder, null, $storeDisk);  
        } catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        // Data file uploaded
        $data['folder'] = $folder;
        $data['name'] = $files['name'];
        $data['stored_file_name'] = $stored_file_name;
        $data['size'] = $files['size'];

        if($status){
            return ['status' =>1, 'item' => $data];
        }else{
           return ['status'=>0,'message' => 'upload fail'];
        }
    }

    /**
     * Get category with categoryId is 0
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Object Category
     */
    public function getRootCategory()
    {
        return self::where('parent_id', 0)->first();
    }
}