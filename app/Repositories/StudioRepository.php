<?php

namespace App\Repositories;

use App\Models\Studio;
use App\Interfaces\StudioRepositoryInterface;
use App\Models\Contact;

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
        return Studio::with('contact')->get();
    }

    public function getById($id){
        return Studio::with('contact')->findOrFail($id);
    }
 
    public function store(array $data){
        $studio = Studio::create($data);
        $studio->addMedia($data['image'])->toMediaCollection('gym');
        $studio->contact()->create($data);
        return $studio;
    }
 
    public function update(array $data, array $contact,$id){
        $studio = Studio::with('contact')->findOrFail($id);
        $studio->update($data);
        $studio->contact()->update($contact);
        return $studio;
    }
     
    public function delete($id){
        Studio::destroy($id);
    }
}
