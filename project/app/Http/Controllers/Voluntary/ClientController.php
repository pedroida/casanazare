<?php

namespace App\Http\Controllers\Voluntary;

use App\Builders\PaginationBuilder;
use App\Exceptions\ClientHasOpenedStayException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Resources\Voluntary\ClientResource;
use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Repositories\Criterias\Common\Where;
use App\Repositories\Criterias\Common\With;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->repository = new ClientRepository();
        $this->resource = ClientResource::class;

        $this->middleware('permission:clients create')->only(['create', 'store']);
        $this->middleware('permission:clients edit')->only(['edit', 'update']);
        $this->middleware('permission:clients show')->only(['show']);
        $this->middleware('permission:clients list')->only(['index']);
        $this->middleware('permission:clients delete')->only(['destroy']);
    }

    public function index()
    {
        return view('voluntary.clients.index');
    }

    public function forbidden()
    {
        return view('voluntary.clients.forbidden_index');
    }

    public function toggleForbidden($id)
    {
        $client = $this->repository->findOrFail($id);
        $client->update(['forbidden' => !$client->forbidden]);

        return $this->chooseReturn('success', _m('common.success.update'));
    }

    public function create()
    {
        $client = new Client();

        return view('voluntary.clients.create', compact('client'));
    }

    public function store(ClientRequest $request)
    {
        $data = $request->validated();

        $user = $this->repository->create($data);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'voluntary.acolhidos.edit', $user->id);
    }

    public function edit($id)
    {
        $client = $this->repository->pushCriteria(new With(['city', 'city.state']))->findOrFail($id);

        return view('voluntary.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, $id)
    {
        $data = $request->validated();

        $this->repository->update($id, $data);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'voluntary.acolhidos.edit', $id);
    }

    public function show($id)
    {
        $client = $this->repository->findOrFail($id);
        return view('voluntary.clients.show', compact('client'));
    }

    public function destroy($id)
    {
        $user = $this->repository->findOrFail($id);

        try {
            $this->repository->delete($user);
            return $this->chooseReturn('success', _m('common.success.destroy'));
        } catch (ClientHasOpenedStayException $e) {
            return $this->chooseReturn('error', _m('client.error.has_stay'));
        } catch (\Exception $e) {
            return $this->chooseReturn('error', _m('common.error.destroy'));
        }
    }

    public function getPagination($pagination)
    {
        $pagination
            ->repository($this->repository)
            ->criterias(new Where('forbidden', false))
            ->defaultOrderBy('created_at', 'DESC')
            ->resource($this->resource);
    }

    public function forbiddenPagination()
    {
        $pagination = new PaginationBuilder();

        $pagination->repository($this->repository)
            ->criterias(new Where('forbidden', true))
            ->defaultOrderBy('created_at', 'DESC')
            ->resource($this->resource);

        return $pagination->build();
    }
}
