<?php

namespace App\Http\Repositories;

use App\Models\Category;

class CategoryRepository
{

    public function __construct() {}
    public function allPagination($limit)
    {
        return Category::where('active', true)->orderByDesc('id')->paginate($limit);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function getOne($id)
    {
        return Category::find($id);
    }

    public function update($id, $data)
    {
        $categoty = Category::find($id);
        $categoty->update($data);
        return $categoty;
    }

    public function datele($id)
    {
        return Category::where('id', $id)->delete();
    }
}
