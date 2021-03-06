<?php 

namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Models\ImageModel;
use App\Services\FileService;

class ProductModel extends Model 
{

    protected $table = 'products';

    protected $fillable = [
        'name', 'description', 'keywords', 'manufacturer', 'origin', 
        'availibility', 'size', 'alias', 'weight', 'dimension', 'price', 
        'old_price', 'category_id', 'meta_description'
    ];    

    /**
     * Relationship with category
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Voids 
     */
    public function categories()
    {
        return $this->belongsTo('App\Models\CategoryModel');
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
     * Create new product
     *
     * @author Thanh Tuan <thanhtuan@cr2011@gmail.com>
     * 
     * @param  Array $data Data input
     * 
     * @return Array       Status
     */
    public function createNewProduct($data)
    {      
        // Format value price
        if (isset($data['price'])) 
            $data['price'] = str_replace(',', '', $data['price']);

        // Format value old price
        if (isset($data['old_price'])) 
            $data['old_price'] = str_replace(',', '', $data['old_price']);

        // Format value availibility
        if (isset($data['availibility'])) 
            $data['availibility'] = str_replace(',', '', $data['availibility']);

        // Format value weight
        if (isset($data['weight'])) 
            $data['weight'] = str_replace(',', '', $data['weight']);

        // Set data keyword
        $data['keywords'] = str_slug($data['name'], '-');

        // Set data alias
        $data['alias'] = str_slug($data['name'], '_');

        $product = self::create($data);

        return $product;
    }

    /**
     * Create new images for product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Array $images Images
     * 
     * @return Int           Status true or false
     */
    public function createImageProduct ($images) 
    {
        $status = 0;

        foreach ($images as $key => &$image) {
            $status = $this->images()->create($image);
        }

        return $status;
    }

    /**
     * Upload image
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
        $storeDisk = 'local_product';                                       

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
            return ['status' => 1, 'item' => $data];
        }else{
           return ['status' => 0,'message' => 'upload fail'];
        }
    }

    /**
     * Update product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Array $data Data input
     * 
     * @return Object      Product
     */
    public function updateProduct($data) 
    {
        $productImage = new ImageModel;

        if (isset($data['fileUploaded']) || isset($data['filesDeleted'])) {

            // Isset files upload
            if (isset($data['fileUploaded']) && count($data['fileUploaded']) > 0) {

                // Create file
                foreach ($data['fileUploaded'] as $key => $file) {
                    $status = $this->images()->create($file);
                }
            }

            // If isset delete files
            if (isset($data['filesDeleted']) && count($data['filesDeleted']) > 0) {
                
                // Get deleted file
                $imagesDelete = $productImage->whereIn('uniId', $data['filesDeleted'])->get();

                // Delete file images
                $this->deleteFileImagesProduct($imagesDelete);

                // Delete all images in table photos
                foreach ($imagesDelete as $key => $imageDelete) {
                    $status = $imageDelete->delete();
                }
            }

        } else {

            // Set alias
            $data['alias'] = str_slug($data['name'], '_');

            // Set keywords
            $data['keywords'] = str_slug($data['keywords'], '-');

            $status = $this->update($data);
        } 

        return $status;
    }

    /**
     * Delete images product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  Array $imagesDelete Array images
     * 
     * @return Void               
     */
    public function deleteFileImagesProduct($imagesDelete) 
    {
        $fileService = new FileService;

        $storeDisk = 'local_product';

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
     * Get list products map with category id
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Array Array prodcut
     */
    public function getListProductMapCategoryId()
    {
        $listMapProductWithCategoryId = [];

        $products = self::select('id', 'name', 'price', 'old_price', 'category_id')->get();

        foreach ($products as $key => &$product) {
            $product->images = $product->images()
                            ->select('folder', 'stored_file_name')
                            ->where('name', 'like', '1%')->first();

            $listMapProductWithCategoryId[$product->category_id][] = $product;
        }
        
        return $listMapProductWithCategoryId;
    }

    /**
     * get sale prodcuts
     *
     * @author Thanh Tuan  <thanhtuancr2011@gmail.com>
     * 
     * @return Array Products
     */
    public function getSaleProducts()
    {        
        // Get product has old_price bigger than price
        $saleProducts = self::select('id', 'name', 'price', 'old_price', 'category_id')->whereRaw('old_price > price')->get();
        
        foreach ($saleProducts as $key => &$product) {
            $product->images = $product->images()
                            ->select('folder', 'stored_file_name')
                            ->where('name', 'like', '1%')->first();

            $listMapProductWithCategoryId[$product->category_id][] = $product;
        }

        return $saleProducts;
    }

    /**
     * Get new products
     *
     * @author Thanh Tuan  <thanhtuancr2011@gmail.com>
     * 
     * @return Array Products
     */
    public function getNewProducts()
    {
        $newProducts = ProductModel::select('id', 'name', 'price', 'old_price', 'category_id')->orderBy('created_at', 'desc')->limit(4)->get();

        foreach ($newProducts as $key => &$product) {
            $product->images = $product->images()
                            ->select('folder', 'stored_file_name')
                            ->where('name', 'like', '1%')->first();
            $listMapProductWithCategoryId[$product->category_id][] = $product;
        }

        return $newProducts;
    }

    /**
     * [getProductsWithCategoryId description]
     *
     * @author Thanh Tuan  <thanhtuancr2011@gmail.com>
     * 
     * @param  String $categoryId Id of category
     * 
     * @return Array              Products
     */
    public function getProductsWithCategoryId($categoryId)
    {
        $products = self::select('id', 'name', 'price', 'old_price', 'category_id')->where('category_id', $categoryId)->get();

        foreach ($products as $key => &$product) {
            $product->images = $product->images()
                            ->select('folder', 'stored_file_name')
                            ->where('name', 'like', '1%')->first();
        }

        return $products;
    }

    public function getProductWithId ($productId)
    {
        $product = self::select('id', 'name', 'price', 'old_price', 'category_id', 'meta_description')->findOrFail($productId);
        $product->images = $product->images()
                            ->select('folder', 'stored_file_name')
                            ->where('name', 'like', '1%')->first();

        return $product;
    }

    /**
     * Delete Product
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @return Bool Status
     */
    public function deleteProduct()
    {
        $imagesDelete = $this->images;

        // Delete file images
        $this->deleteFileImagesProduct($imagesDelete);

        $this->images()->delete();

        $status = $this->delete();

        return $status;
    }

    /**
     * Get products with name
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  String $name Search name
     * 
     * @return Array        Products
     */
    public function getProductWithName ($name) 
    {
        $products = self::where('name', 'like', '%'.$name.'%')
                        ->select('id', 'name', 'price', 'old_price', 'category_id')
                        ->get();

        foreach ($products as $key => &$product) {
            $product->images = $product->images()
                             ->select('folder', 'stored_file_name')
                             ->where('name', 'like', '1%')->first();
        }
        
        return $products;
    }
}
