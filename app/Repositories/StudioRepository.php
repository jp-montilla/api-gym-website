<?php

namespace App\Repositories;

use App\Models\Studio;
use App\Interfaces\StudioRepositoryInterface;

class StudioRepository implements StudioRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index() {
        return Studio::all();
    }

    public function getById($id){
        return Studio::findOrFail($id);
     }
 
     public function store(array $data){
        return Studio::create($data);
     }
 
     public function update(array $data,$id){
        return Studio::whereId($id)->update($data);
     }
     
     public function delete($id){
        Studio::destroy($id);
     }
}
