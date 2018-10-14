<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use  App\Model\Product;
use  App\Model\Category;
use Image as ImageLib;
use Storage;
use File;

class Image
{
    const PRODUCT_IMAGE_BASE_PATH = 'C:\xampp182\htdocs\my_shop\public\media\product';
    const PRODUCT_LARGE_PATH = self::PRODUCT_IMAGE_BASE_PATH . "\large";
    const PRODUCT_SMALL_PATH = self::PRODUCT_IMAGE_BASE_PATH . "\small";
    const PRODUCT_THUMB_PATH = self::PRODUCT_IMAGE_BASE_PATH . "\\thumb";
    const LARGE_WIDTH = 1000;
    const SMALL_WIDTH = 400;
    const THUMB_WIDTH = 100;

    public function __construct()
    {
    }

    public static function saveGalleryImages($input)
    {
        if (!isset($input['base_image'])) {
            return false;
        }
        $image_arr = array();
        $images = $input['base_image'];
        $basePath = public_path(self::PRODUCT_IMAGE_BASE_PATH);
        self::createPath($basePath);
        foreach ($images as $image) {
            try {
                $image_name = time() . $image->getClientOriginalName();
                self::save($image, $image_name, 'large');
                self::save($image, $image_name, 'small');
                self::save($image, $image_name, 'thumb');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $image_arr[] = $image_name;
        }
//        _log($image_arr);
        return $image_arr;
    }

    /**
     * @param $destinationPath
     */
    public static function createPath($destinationPath)
    {
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
    }

    public static function save($image, $image_name, $image_type)
    {
        if (!isset($image) || !$image_type) return false;
        switch ($image_type) {
            case 'large':
                $path = self::PRODUCT_LARGE_PATH;
                $width = self::LARGE_WIDTH;
                break;
            case 'small':
                $path = self::PRODUCT_SMALL_PATH;
                $width = self::SMALL_WIDTH;
                break;
            case 'thumb':
                $path = self::PRODUCT_THUMB_PATH;
                $width = self::THUMB_WIDTH;
                break;
            default:
                $path = self::PRODUCT_SMALL_PATH;
                $width = self::SMALL_WIDTH;
        }
        self::createPath($path);
        $img = ImageLib::make($image->getRealPath());
        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/' . $image_name);
    }
}