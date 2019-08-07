<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StorageService;

class StorageController extends Controller
{
    // ShareSerice
    protected $shareService;
    protected $storageService;

    // Init
    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    function get($slide_uid) {
        return $this->storageService->get($slide_uid);
    }
    function insertSlide(Request $req) {
        return $this->storageService->insertSlide($req);
    }
    function insertPage(Request $req) {
        return $this->storageService->insertPage($req);
    }
    function delete($slide_uid) {
        return $this->storageService->delete($slide_uid);
    }
}
