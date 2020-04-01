<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VoluntaryUserRequest;
use App\Http\Resources\Admin\VoluntaryUserResource;
use App\Models\User;
use App\Repositories\Criterias\Common\UserRole;
use App\Repositories\UserRepository;

class VoluntaryUserController extends Controller
{
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->resource = VoluntaryUserResource::class;

        $this->middleware('permission:users create voluntary')->only(['create', 'store']);
        $this->middleware('permission:users edit voluntary')->only(['edit', 'update']);
        $this->middleware('permission:users show voluntary')->only(['show']);
        $this->middleware('permission:users list voluntary')->only(['index']);
        $this->middleware('permission:users delete voluntary')->only(['destroy']);
    }

    public function index()
    {
        return view('admin.users.voluntary.index');
    }

    public function create()
    {
        $user = new User();

        return view('admin.users.voluntary.create', compact('user'));
    }

    public function store(VoluntaryUserRequest $request)
    {
        $userData = $request->validated();

        $user = $this->repository->createUser($userData);
        $user->assignRole(UserRolesEnum::VOLUNTARY);

        $message = _m('common.success.create');
        return $this->chooseReturn('success', $message, 'admin.voluntarios.edit', $user->id);
    }

    public function edit($id)
    {
        $user = $this->repository->findOrFail($id);

        return view('admin.users.voluntary.edit', compact('user'));
    }

    public function update(VoluntaryUserRequest $request, $id)
    {
        $userData = $request->validated();

        $user = $this->repository->findOrFail($id);
        $this->repository->updateUser($user, $userData);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'admin.voluntarios.edit', $id);
    }

    public function show($id)
    {
        $user = $this->repository->findOrFail($id);
        return view('admin.users.voluntary.show', compact('user'));
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
            ->criterias([
                new UserRole(UserRolesEnum::VOLUNTARY),
            ])
            ->defaultOrderBy('created_at', 'DESC')
            ->resource($this->resource);
    }
}
