<?php

namespace App\Services;

use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Validation\Factory as ValidateFactory;
use Carbon\Carbon;

/**
 * Class ShareService
 * @package App\Services
 */
class UserService extends Service
{
    protected $usersRepository;


    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    // ユーザ情報取得
    public function get($uid)
    {
        return $this->usersRepository->get($uid);
    }

    // ユーザ情報取得
    public function limit($uid)
    {
        return $this->usersRepository->limit($uid);
    }

    // ユーザ更新
    public function update($data)
    {
        return $this->usersRepository->update($data);
    }
}
