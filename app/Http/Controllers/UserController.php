<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Services\HelperService;
use App\Services\UserService;
use App\Traits\HasSearchAny;

class UserController extends Controller
{
    use HasSearchAny;

    public function __construct(private HelperService $helperService, private UserService $userService) {}

    public function showDashboard()
    {
        $result = $this->userService->populateDashboard();
        return view("user.dashboard", compact("result"));
    }

    public function edit()
    {
        return view("user.profile");
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->userService->updatePassword($request);
    }
}
