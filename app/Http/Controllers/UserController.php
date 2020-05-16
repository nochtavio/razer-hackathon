<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;

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

        // Store Photo to S3
        try {
            $path = Storage::putFile('photo', $request->file('photo'), 'public');
        } catch (\Throwable $th) {
            $this->sendError("Issue on uploading photo", 422);
        }
        // End Store Photo to S3

        // Create Mambu Client
        $createClient = $this->mambuEngine->createClient($input['first_name'], $input['last_name']);

        if(!$createClient['result']){
            $this->sendError("Issue on creating Mambu client", 422);
        }

        $mambuClient = $createClient['data']->client;
        // End Create Mambu Client

        // Create Mambu Account
        $createAccount  = $this->mambuEngine->createClientAccount($mambuClient->encodedKey);

        if(!$createAccount['result']){
            $this->sendError("Issue on creating Mambu client", 422);
        }

        $mambuAccount = $createAccount['data']->savingsAccount;
        // End Create Mambu Account

        $user = User::create([
            'first_name'        => $input['first_name'],
            'last_name'         => $input['last_name'],
            'phone_no'          => $input['phone_no'],
            'photo'             => $path,
            'ext_account_id'    => $mambuAccount->encodedKey
        ]);

        if(!$user){
            $this->sendError("Issue on creating user", 422);
        }

        return $this->sendResponse(null, 'User is successfully created');
    }
}
