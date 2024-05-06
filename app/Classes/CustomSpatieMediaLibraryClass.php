<?php

namespace App\Classes;

class CustomSpatieMediaLibraryClass
{

    /**
     * Replace single image from media collection
     */
    public static function replaceImageInMediaCollection($image, $model, string $mediaCollection) {
        if ($image !== null) {
            $model->clearMediaCollection($mediaCollection);
            $model->addMedia($image)->toMediaCollection($mediaCollection);
        }
    }

    /**
     * Store images to media collection
     */
    public static function storeImagesToMediaCollection(array $images, $model, string $mediaCollection) {
        if ($images !== null){
            foreach ($images as $image) {
                $model->addMedia($image)->toMediaCollection($mediaCollection);
            }
        }
    }

    /**
     * delete images from media collection
     */
    public static function deleteImagesFromMediaCollection($model, array $url, $mediaCollection) {
        foreach($model->getMedia($mediaCollection) as $image) {
            if (in_array($image->getFullUrl(),$url)) {
                $image->delete();
            }
        }
    }
    

}
