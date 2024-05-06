<?php

namespace App\Repositories;

use App\Classes\CustomSpatieMediaLibraryClass;
use App\Interfaces\CoachRepositoryInterface;
use App\Models\Coach;

class CoachRepository implements CoachRepositoryInterface
{
    
    public function index() {
        return Coach::all();
    }

    public function getById($id) {
        return Coach::with('studio')->findOrFail($id);
    }

    public function store(array $data) {
        $coach = Coach::create($data);
        $coach->addMedia($data['image'])->toMediaCollection('coach');

        // store images to gallery media collection
        CustomSpatieMediaLibraryClass::storeImagesToMediaCollection($data['gallery'],$coach,'gallery');
        
        return $coach;
    }

    public function update(array $data, array $deletedMedia, $id) {
        $coach = Coach::findOrFail($id);
        $coach->update($data);
        // replace image from coach media collection
        CustomSpatieMediaLibraryClass::replaceImageInMediaCollection($data['image'],$coach,'coach');

        // delete images from gallery media collection
        CustomSpatieMediaLibraryClass::deleteImagesFromMediaCollection($coach,$deletedMedia,'gallery');

        // insert images uploaded to gallery media collection
        CustomSpatieMediaLibraryClass::storeImagesToMediaCollection($data['gallery'],$coach,'gallery');

        return $coach;
    }
    
    public function delete($id) {
        Coach::destroy($id);
    }

}
