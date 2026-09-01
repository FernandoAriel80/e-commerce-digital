<?php

namespace App\Http\Services;

use App\Http\Repositories\CategoryRepository;
use Exception;

class CategoryService
{
    private CategoryRepository $categoryRepository;
    private $limit = 8;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllPagination()
    {
        return $this->categoryRepository->allPagination($this->limit);
    }


    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function getOneToUpdate($id)
    {
        $category = $this->categoryRepository->getOne($id);
        if (!$category) throw new Exception('Error al conseguir la categoria.');
        return $category;
    }

    public function updateOne($id, $data)
    {
        $category = $this->categoryRepository->update($id, $data);
        if (!$category) throw new Exception('Error al actualizar categoria.');
        return $category;
    }

    public function deleteOne($id)
    {
        $category = $this->categoryRepository->datele($id);

        if (!$category) throw new Exception('Error al eliminar la categoria.');
        return $category;
    }
}
