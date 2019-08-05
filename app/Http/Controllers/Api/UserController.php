<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    // Init
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function get($uid) {
        return $this->userService->get($uid);
    }

    function limit($uid) {
        return $this->userService->limit($uid);
    }

    function update(Request $req) {
        return $this->userService->update($req);
    }
}
