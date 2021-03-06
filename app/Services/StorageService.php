<?php

namespace App\Services;

use App\Repositories\Storage\StorageRepositoryInterface;
use Illuminate\Validation\Factory as ValidateFactory;
use Carbon\Carbon;

/**
 * Class ShareService
 * @package App\Services
 */
class StorageService extends Service
{
    protected $storageRepository;


    public function __construct(StorageRepositoryInterface $storageRepository)
    {
        $this->storageRepository = $storageRepository;
    }

    // スライド取得
    public function get($slide_uid)
    {
        return $this->storageRepository->get($slide_uid);
    }

    // スライド登録
    public function insertSlide($data)
    {
        return $this->storageRepository->insertSlide($data);
    }

    public function insertPage($data)
    {
        return $this->storageRepository->insertPage($data);
    }

    // スライド削除
    public function delete($slide_uid)
    {
        return $this->storageRepository->delete($slide_uid);
    }
}
