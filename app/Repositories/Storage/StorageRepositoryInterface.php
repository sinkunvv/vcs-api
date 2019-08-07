<?php
namespace App\Repositories\Storage;

use Illuminate\Http\Request;

interface StorageRepositoryInterface
{
    // スライド取得
    public function get($slide_uid);

    // スライド登録
    public function insertSlide($data);

    public function insertPage($data);

    public function delete($slide_uid);
}
