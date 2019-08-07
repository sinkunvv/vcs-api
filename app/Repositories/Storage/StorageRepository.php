<?php

namespace App\Repositories\Storage;

use Google\Cloud\Storage\StorageClient;
use DB;
use Log;
use App\Models\Users;
use App\Models\Slides;
use App\Models\Pages;

class StorageRepository implements StorageRepositoryInterface
{
    protected $users;
    protected $slides;
    protected $pages;


    public function __construct(Users $users, Slides $slides, Pages $pages)
    {
        $this->users = $users;
        $this->slides = $slides;
        $this->pages = $pages;
    }

    public function get($slide_uid)
    {
        $result = array('code' => 1, 'msg' => '存在しない', 'data' => []);

        // スライドの存在確認
        if (!$this->slides->where('slide_uid', $slide_uid)->where('active', 1)->exists()) {
            return $result;
        }

        // スライドIDに紐づくデータ取得
        $res = $this->slides
            ->select('pages.page', 'pages.url')
            ->join('pages', 'slides.id', 'pages.slide_id')
            ->where('slides.slide_uid', $slide_uid)
            ->where('slides.active', 1)
            ->orderBy('pages.page', 'asc')
            ->get()
            ->toArray();
        Log::Info($res);
        $result = $res;
        return json_encode($result);
    }

    public function insertSlide($data)
    {
        $slide = $this->slides->newInstance();

        DB::beginTransaction();
        try {
            $user = $this->users->where('firebase_uid', $data->uid)->first();

            // スライド登録
            $slide->user_id = $user->id;
            $slide->slide_uid = $data->slide_uid;
            $slide->pages = $data->pageNum;
            $slide->save();

            DB::commit();
            $result = array('code' => 0, 'msg' => '登録完了', 'data' => $slide->id);
        } catch (\Exeption $e) {
            // エラー発生時ロールバック
            $result = array('code' => 2, 'msg' => '登録失敗', 'data' => $e);
            DB::rollback();
            Log::Info($e);
        }
        return $result;
    }


    public function insertPage($data)
    {
        // スライドの存在確認
        if (!$this->slides->where('slide_uid', $data->slide_uid)->where('active', 1)->exists()) {
            $result = array('code' => 1, 'msg' => '存在しない', 'data' => []);
            return $result;
        }

        $slide = $this->slides->select('id')->where('slide_uid', $data->slide_uid)->where('active', 1)->first();
        $page = $this->pages->newInstance();

        DB::beginTransaction();
        try {
            // スライドページURL登録
            $page->slide_id = $slide->id;
            $page->page = $data->index;
            $page->url = $data->url;
            $page->save();
            // 問題なければ0で返却
            DB::commit();
            $result = array('code' => 0, 'msg' => '登録完了', 'data' => $data);
        } catch (\Exeption $e) {
            // エラー発生時ロールバック
            $result = array('code' => 2, 'msg' => '登録失敗', 'data' => $e);
            DB::rollback();
            Log::Info($e);
        }
        return $result;
    }

    public function delete($slide_uid)
    {
        // スライドの存在確認
        $slide = $this->slides->where('slide_uid', $slide_uid)->where('active', 1);
        if (!$slide->exists()) {
            $result = array('code' => 1, 'msg' => '存在しない', 'data' => []);
            return $result;
        }

        DB::beginTransaction();
        try {
            //Active Flg Disable
            $slide->update(['active' => 0]);

            //Active Flg Disable
            // $slide->first();
            // $pages = $this->pages->where('slide_id', $slide_id)->where('active', 1);
            // $pages->update(['active' => 0]);

            DB::commit();
            $result = array('code' => 0, 'msg' => '削除完了', 'data' => []);
        } catch (\Exeption $e) {
            // エラー発生時ロールバック
            $result = array('code' => 3, 'msg' => '削除失敗', 'data' => $e);
            DB::rollback();
            Log::Info($e);
        }
        return $result;
    }
}
