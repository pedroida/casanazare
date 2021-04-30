<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnitRequest;
use App\Http\Resources\Admin\UnitResource;
use App\Models\Unit;
use App\Repositories\UnitRepository;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->repository = new UnitRepository();
        $this->resource = UnitResource::class;

        $this->middleware('permission:units create')->only(['create', 'store']);
        $this->middleware('permission:units edit')->only(['edit', 'update']);
        $this->middleware('permission:units list')->only(['index']);
        $this->middleware('permission:units delete')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.units.index');
    }

    public function create()
    {
        $unit = new Unit(['name' => '']);

        return view('admin.units.create', compact('unit'));
    }

    public function store(UnitRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.unidades.index');
    }

    public function edit($id)
    {
        $unit = $this->repository->findOrFail($id);
        return view('admin.units.edit', compact('unit'));
    }

    public function update(UnitRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.unidades.index');
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
