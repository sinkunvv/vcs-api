<?php

namespace App\Repositories\Users;

use DB;
use App\Models\Users;

class UsersRepository implements UsersRepositoryInterface
{
    protected $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }


    public function limit($uid)
    {
        // ユーザ確認
        $user = $this->users->where('firebase_uid', $uid);
        if (!$user->exists()) {
            $result = array('code' => 1, 'msg' => '存在しない', 'data' => 0);
            return $result;
        }

        $data = $user->first();
        $result = array('code' => 0, 'msg' => 'UID確認完了', 'data' => $data->limit);
        return $result;
    }

    public function get($uid)
    {
        // ユーザ確認
        if (!$this->users->where('firebase_uid', $uid)->exists()) {
            $result = array('code' => 1, 'msg' => '存在しない', 'data' => []);
            return $result;
        }

        $data = $this->users
            ->select('slides.slide_uid', 'slides.pages', 'pages.url')
            ->join('slides', 'users.id', 'slides.user_id')
            ->join('pages', 'slides.id', 'pages.slide_id')
            ->where('users.firebase_uid', $uid)
            ->where('pages.page', 1)
            ->where('slides.active', 1)
            ->where('pages.active', 1)
            ->orderBy('slides.id', 'desc')
            ->get();

        if (!is_null($data)) {
            $data->toArray();
        }

        $result = array('code' => 0, 'msg' => '取得完了', 'data' => $data);
        return $result;
    }

    public function update($data)
    {
        $user = $this->users->where('firebase_uid', $data->uid)->first();
        if (is_null($user)) {
            $user = $this->users->newInstance();
        }

        DB::beginTransaction();
        try {
            // スライド登録
            $user->firebase_uid = $data->uid;
            $user->display_name = $data->displayName;
            $user->icon = $data->photoURL;
            $user->save();

            DB::commit();
            $result = array('code' => 0, 'msg' => '登録完了', 'data' => []);
        } catch (\Exeption $e) {
            // エラー発生時ロールバック
            $result = array('code' => 2, 'msg' => '更新失敗', 'data' => $e);
            DB::rollback();
            Log::Info($e);
        }
        return $result;
    }
}
