<?php

namespace App\Repositories;

use App\Classes\CustomSpatieMediaLibraryClass;
use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{

    public function index() {
        return Blog::all();
    }

    public function getById($id) {
        return Blog::findOrFail($id);
    }

    public function store(array $data) {
        $blog = Blog::create($data);
        $blog->addMedia($data['image'])->toMediaCollection('blog');
        return $blog;
    }

    public function update(array $data, $id) {
        $blog = Blog::findOrFail($id);
        // replace image from blog media collection
        CustomSpatieMediaLibraryClass::replaceImageInMediaCollection($data['image'],$blog,'blog');
        $blog->update($data);
        return $blog;
    }
    
    public function delete($id) {
        Blog::destroy($id);
    }
}
