<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SourceRequest;
use App\Http\Resources\Admin\SourceResource;
use App\Models\Source;
use App\Repositories\SourceRepository;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->repository = new SourceRepository();
        $this->resource = SourceResource::class;

        $this->middleware('permission:sources create')->only(['create', 'store']);
        $this->middleware('permission:sources edit')->only(['edit', 'update']);
        $this->middleware('permission:sources show')->only(['show']);
        $this->middleware('permission:sources list')->only(['index']);
        $this->middleware('permission:sources delete')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.sources.index');
    }

    public function create()
    {
        $source = new Source();

        return view('admin.sources.create', compact('source'));
    }

    public function store(SourceRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.origens.index');
    }

    public function edit($id)
    {
        $source = $this->repository->findOrFail($id);
        return view('admin.sources.edit', compact('source'));
    }

    public function update(SourceRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.origens.index');
    }

    public function show(Source $source)
    {
        return view('admin.sources.show', compact('source'));
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
