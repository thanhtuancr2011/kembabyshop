<?php 

use App\Models\CategoryModel;

/**
 * Get all categories and image of categories
 *
 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
 * 
 * @return Array Categories
 */
function getCategories()
{
	// Get categories
    $categories = CategoryModel::where('sort_order', '!=', 0)
    						   ->select('id', 'name')
    						   ->orderBy('sort_order', 'asc')
    						   ->get();

    foreach ($categories as &$category) {
    	// Category images menu
        $imageMenu = $category->images()->select('folder', 'stored_file_name')->where('name', 'like', 'm%')->first();
        $category->imageMenuSrc = $imageMenu->folder . $imageMenu->stored_file_name;

        // Category images feature
        $imageFeature = $category->images()->select('folder', 'stored_file_name')->where('name', 'like', 'f%')->first();
        $category->imageFeatureSrc = $imageFeature->folder . $imageFeature->stored_file_name;
    };

    return $categories;
}