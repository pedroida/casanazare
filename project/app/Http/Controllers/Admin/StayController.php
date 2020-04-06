<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Requests\Admin\SourceRequest;
use App\Http\Requests\Admin\StayRequest;
use App\Http\Resources\Admin\ClientResource;
use App\Http\Resources\Admin\SourceResource;
use App\Http\Resources\Admin\StayResource;
use App\Models\Source;
use App\Models\Stay;
use App\Models\User;
use App\Repositories\ClientRepository;
use App\Repositories\Criterias\Common\UserRole;
use App\Repositories\Criterias\Common\With;
use App\Repositories\SourceRepository;
use App\Repositories\StayRepository;
use App\Repositories\UserRepository;

class StayController extends Controller
{
    public function __construct()
    {
        $this->repository = new StayRepository();
        $this->resource = StayResource::class;

        $this->middleware('permission:stays create')->only(['create', 'store']);
        $this->middleware('permission:stays edit')->only(['edit', 'update']);
        $this->middleware('permission:stays show')->only(['show']);
        $this->middleware('permission:stays list')->only(['index']);
        $this->middleware('permission:stays delete')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.stays.index');
    }

    public function create()
    {
        $stay = new Stay();
        $users = (new UserRepository())->all();
        $clients = (new ClientRepository())->all();
        $sources = (new SourceRepository())->all();
        return view('admin.stays.create', compact('stay', 'clients', 'sources', 'users'));
    }

    public function store(StayRequest $request)
    {
        $data = $request->validated();

        $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.estadias.index');
    }

    public function edit($id)
    {
        $stay = $this->repository->findOrFail($id);
        $users = (new UserRepository())->all();
        $clients = (new ClientRepository())->all();
        $sources = (new SourceRepository())->all();
        return view('admin.stays.edit', compact('stay', 'users', 'clients', 'sources'));
    }

    public function update(StayRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.estadias.index');
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
            ->criterias([
                new With(['responsible', 'source', 'client'])
            ])
            ->resource($this->resource);
    }
}
