<?php

namespace App\Repositories\Storage;

use Google\Cloud\Storage\StorageClient;
use DB;
use Log;
use App\Models\Slides;
use App\Models\Pages;

class StorageRepository implements StorageRepositoryInterface
{
    protected $slides;
    protected $pages;


    public function __construct(Slides $slides, Pages $pages)
    {
        $this->slides = $slides;
        $this->pages = $pages;
    }

    // public function downloadPDF()
    // {
    //     $client = new StorageClient();
    //     $bucket = $client->bucket('vrchat-slide-system.appspot.com');
    //     $object = $bucket->object('slide/fef38547-1da5-45c4-8569-f7452af36a83');
    //     $object->downloadToFile(storage_path('temp/sample.pdf'));
    //     return "ok";
    // }

    public function get($slide_name)
    {
        $result = array('code' => 1, 'msg' => '存在しない', 'data' => []);

        // スライドの存在確認
        if (!$this->slides->where('name', $slide_name)->exists()) {
            return $result;
        }

        // スライドIDに紐づくデータ取得
        $res = $this->slides
            ->select('pages.page', 'pages.url')
            ->join('pages', 'slides.id', 'pages.slide_id')
            ->where('slides.name', $slide_name)
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
            // スライド登録
            $slide->name = $data->name;
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
        if (!$this->slides->where('name', $data->name)->exists()) {
            $result = array('code' => 1, 'msg' => '存在しない', 'data' => []);
            return $result;
        }

        $slide = $this->slides->select('id')->where('name', $data->name)->first();
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
}
