<?php
namespace App\Repositories\Users;

use Illuminate\Http\Request;

interface UsersRepositoryInterface
{
    // ユーザ確認
    public function limit($uid);

    // ユーザ情報取得
    public function get($uid);

    // ユーザ更新
    public function update($uid);

}
