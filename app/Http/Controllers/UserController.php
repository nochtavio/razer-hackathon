<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Users\StoreUser;

use App\Engines\MambuEngine;

use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public $mambuEngine;

    public function __construct(MambuEngine $mambuEngine)
    {
        $this->mambuEngine = $mambuEngine;
    }

    public function store(StoreUser $request)
    {
        DB::beginTransaction();

        $input = $request->all();

        try {
            $path = Storage::putFile('photo', $request->file('photo'), 'public');
        } catch (\Throwable $th) {
            $this->sendError("Issue on uploading photo", 422);
        }

        return $this->sendResponse(null, 'Mambu client created');
    }
}
