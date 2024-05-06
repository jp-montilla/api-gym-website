<?php

namespace App\Repositories;

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
        if ($data['gallery'] !== null){
            foreach ($data['gallery'] as $gallery) {
                $coach->addMedia($gallery)->toMediaCollection('gallery');
            }
        }
        return $coach;
    }

    public function update(array $data,$id) {
        return Coach::whereId($id)->update($data);
    }
    
    public function delete($id) {
        Coach::destroy($id);
    }
}
