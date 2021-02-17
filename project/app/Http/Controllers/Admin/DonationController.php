<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DonationRequest;
use App\Http\Resources\Admin\DonationResource;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Unit;
use App\Repositories\BaseRepository;
use App\Repositories\DonationRepository;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->repository = new DonationRepository();
        $this->resource = DonationResource::class;

        $this->middleware('permission:donations create')->only(['create', 'store']);
        $this->middleware('permission:donations edit')->only(['edit', 'update']);
        $this->middleware('permission:donations show')->only(['show']);
        $this->middleware('permission:donations list')->only(['index']);
        $this->middleware('permission:donations delete')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.donations.index');
    }

    public function create()
    {
        $donation = new Donation();
        $units = (new BaseRepository(Unit::class))->all()->sortBy('name');
        $categories = (new BaseRepository(Category::class))->all()->sortBy('name');

        return view('admin.donations.create', compact('donation', 'units', 'categories'));
    }

    public function store(DonationRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.doacoes.index');
    }

    public function edit($id)
    {
        $donation = $this->repository->findOrFail($id);
        $units = (new BaseRepository(Unit::class))->all()->sortBy('name');
        $categories = (new BaseRepository(Category::class))->all()->sortBy('name');

        return view('admin.donations.edit', compact('donation', 'units', 'categories'));
    }

    public function update(DonationRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.doacoes.index');
    }

    public function show(Donation $source)
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
