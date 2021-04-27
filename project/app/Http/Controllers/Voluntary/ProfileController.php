<?php

namespace App\Http\Controllers\Voluntary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ProfileRequest;
use App\Repositories\UserRepository;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->middleware('permission:profile edit voluntary')->only(['edit', 'update']);
    }

    public function index()
    {
        $user = current_user();
        return view('voluntary.profile.index', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $userData = $request->validated();

        $user = current_user();
        $this->repository->updateUser($user, $userData);

        $message = _m('common.success.update');
        return $this->chooseReturn('success', $message, 'voluntary.profile');
    }
}
