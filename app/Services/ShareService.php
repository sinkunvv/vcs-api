<?php

namespace App\Services;

use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Validation\Factory as ValidateFactory;
use Carbon\Carbon;

/**
 * Class ShareService
 * @package App\Services
 */
class ShareService extends Service
{
    protected $usersRepository;


    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    // パスランキング取得
    public function getData($user_id)
    {
        $data = array();
        return $data;
    }

}
