<?php

namespace App\Interfaces;

interface CoachRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, array $deletedMedia, $id);
    public function delete($id);
}
