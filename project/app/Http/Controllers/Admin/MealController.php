<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MealRequest;
use App\Http\Resources\Admin\MealResource;
use App\Repositories\Criterias\Common\Where;
use App\Repositories\MealRepository;

class MealController extends Controller
{
    public function __construct()
    {
        $this->repository = new MealRepository();
        $this->resource = MealResource::class;

        $this->middleware('permission:meals create')->only(['create', 'store']);
        $this->middleware('permission:meals edit')->only(['edit', 'update']);
        $this->middleware('permission:meals show')->only(['show']);
        $this->middleware('permission:meals list')->only(['index']);
        $this->middleware('permission:meals delete')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.meals.index');
    }

    public function store(MealRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.origens.index');
    }

    public function update(MealRequest $request, $id)
    {
        $data = $request->only(['breakfasts', 'lunches', 'dinners']);

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.origens.index');
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
        $criterias = [];

        if (request()->get('day')) {
            $criterias[] = new Where('day', request()->get('day'));
        }

        $pagination
            ->repository($this->repository)
            ->criterias($criterias)
            ->defaultOrderBy('day', 'desc')
            ->resource($this->resource);
    }
}
