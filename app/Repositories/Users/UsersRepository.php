<?php

namespace App\Repositories\Users;

use DB;
use App\Models\Users;

class UsersRepository implements UsersRepositoryInterface
{
    protected $api_users;

    public function __construct(Users $users)
    {
        $this->api_users = $users;
    }


    public function isExists($user_id)
    {
        // ユーザ確認
        $result = $this->api_users
            ->where('user_id', $user_id)
            ->exists();

        return $result;
    }
}
