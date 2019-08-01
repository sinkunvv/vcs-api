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

    function get($slide_name) {
        return $this->storageService->get($slide_name);
    }
    function insertSlide(Request $req) {
        return $this->storageService->insertSlide($req);
    }
    function insertPage(Request $req) {
        return $this->storageService->insertPage($req);
    }
}
