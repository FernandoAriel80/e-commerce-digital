<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            $categories = $this->categoryService->getAllPagination();

            return view('pages.admin.dashboard-category', [
                'categories' => $categories
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'slug' => 'required|max:50|unique:categories,slug',
            'description' => 'required|max:200',
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El máximo de caracteres es de 50.',
            'slug.required' => 'El nombre de identificación es requerido.',
            'slug.max' => 'El máximo de caracteres es de 50.',
            'slug.unique' => 'El nombre de identificación tiene que ser unico.',
            'description.required' => 'La descripción es requerida.',
            'description.max' => 'El máximo de caracteres es de 200.'
        ]);
        try {

            $this->categoryService->createCategory($validated);

            return redirect()->route('dashboard.category');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage()
            ])->withInput();
        }
    }

    public function updateView($id)
    {
        try {
            $category = $this->categoryService->getOneToUpdate($id);
            return view('pages.admin.category.update-category')->with([
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:50',
                'slug' => 'required|max:50',
                'description' => 'required|max:200',
            ], [
                'name.required' => 'El nombre es requerido.',
                'name.max' => 'El máximo de caracteres es de 50.',
                'slug.required' => 'El nombre de identificación es requerido.',
                'slug.max' => 'El máximo de caracteres es de 50.',
                'description.required' => 'La descripción es requerida.',
                'description.max' => 'El máximo de caracteres es de 200.'
            ]);
            $this->categoryService->updateOne($id, $validated);
            return redirect()->route('dashboard.category')->with([
                'success' => 'categoria actualizada exitosamente.'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ])->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $this->categoryService->deleteOne($id);
            return redirect()->route('dashboard.category')->with([
                'success' => 'La categoria a sido eliminado exitosamente.'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ])->withInput();
        }
    }
}
