<?php
namespace App\Repositories\Users;

use Illuminate\Http\Request;

interface UsersRepositoryInterface
{
    // ユーザ存在確認
    public function isExists($user_id);
}
