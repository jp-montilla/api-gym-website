<?php

namespace App\Repositories;

use App\Interfaces\FAQRepositoryInterface;
use App\Models\FAQ;

class FAQRepository implements FAQRepositoryInterface
{
    public function index() {
        return FAQ::all();
    }

    public function getById($id) {
        return FAQ::findOrFail($id);
    }

    public function store(array $data) {
        return FAQ::create($data);
    }

    public function update(array $data, $id) {
        $blog = FAQ::findOrFail($id);
        $blog->update($data);
        return $blog;
    }
    
    public function delete($id) {
        FAQ::destroy($id);
    }
}
