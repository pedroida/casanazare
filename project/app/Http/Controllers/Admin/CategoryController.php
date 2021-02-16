<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->repository = new CategoryRepository();
        $this->resource = CategoryResource::class;

        $this->middleware('permission:categories create')->only(['create', 'store']);
        $this->middleware('permission:categories edit')->only(['edit', 'update']);
        $this->middleware('permission:categories list')->only(['index']);
        $this->middleware('permission:categories delete')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        $category = new Category();

        return view('admin.categories.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.categorias.index');
    }

    public function edit($id)
    {
        $category = $this->repository->findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.categorias.index');
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return $this->chooseReturn('success', _m('common.success.destroy'));
        } catch (\Exception $e) {
            return $this->chooseReturn('error', _m('common.error.destroy'));
        }
    }

    public function getPagination($pagination)
    {
        $pagination
            ->repository($this->repository)
            ->defaultOrderBy('name', 'DESC')
            ->resource($this->resource);
    }
}
