<?php

namespace App\Repositories;

use App\Interfaces\CoachRepositoryInterface;
use App\Models\Coach;

class CoachRepository implements CoachRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return Coach::all();
    }

    public function getById($id){
       return Coach::findOrFail($id);
    }

    public function store(array $data){
       return Coach::create($data);
    }

    public function update(array $data,$id){
       return Coach::whereId($id)->update($data);
    }
    
    public function delete($id){
       Coach::destroy($id);
    }
}
