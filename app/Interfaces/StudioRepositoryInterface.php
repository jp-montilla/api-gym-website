<?php

namespace App\Interfaces;

interface StudioRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update(array $data,array $contact,$id);
    public function delete($id);
}
