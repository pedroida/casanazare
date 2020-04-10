<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Resources\Admin\ClientResource;
use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Repositories\Criterias\Common\With;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->repository = new ClientRepository();
        $this->resource = ClientResource::class;

        $this->middleware('permission:users create client')->only(['create', 'store']);
        $this->middleware('permission:users edit client')->only(['edit', 'update']);
        $this->middleware('permission:users show client')->only(['show']);
        $this->middleware('permission:users list client')->only(['index']);
        $this->middleware('permission:users delete client')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.clients.index');
    }

    public function create()
    {
        $client = new Client();

        return view('admin.clients.create', compact('client'));
    }

    public function store(ClientRequest $request)
    {
        $data = $request->validated();

        $user = $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.acolhidos.edit', $user->id);
    }

    public function edit($id)
    {
        $client = $this->repository->pushCriteria(new With(['city', 'city.state']))->findOrFail($id);

        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.acolhidos.edit', $id);
    }

    public function show($id)
    {
        $client = $this->repository->findOrFail($id);
        return view('admin.clients.show', compact('client'));
    }

    public function destroy($id)
    {
        $user = $this->repository->findOrFail($id);

        try {
            $this->repository->delete($user);
            return $this->chooseReturn('success', _m('common.success.destroy'));
        } catch (\Exception $e) {
            return $this->chooseReturn('error', _m('common.error.destroy'));
        }
    }

    public function getPagination($pagination)
    {
        $pagination
            ->repository($this->repository)
            ->defaultOrderBy('created_at', 'DESC')
            ->resource($this->resource);
    }
}
