<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function storeClient(Request $request)
    {
        $input      = $request->all();

        $branchKey  = env('MAMBU_BRANCH_KEY', null);

        if($branchKey == null){
            return $this->sendError('MAMBU BRANCH KEY is missing');
        }

        $createClient   = callMambu([
                            'method'    => 'POST',
                            'url'       => '/api/clients',
                            'json'      => [
                                "client" => [
                                    "firstName"         => "Alief",
                                    "lastName"          => "Nochtavio",
                                    "preferredLanguage" => "ENGLISH",
                                    "notes"             => "Enjoys playing DotA",
                                    "assignedBranchKey" => env('MAMBU_BRANCH_KEY')
                                ],
                                "idDocuments" => [
                                    [
                                        "identificationDocumentTemplateKey" => "8a8e867271bd280c0171bf7e4ec71b01",
                                        "issuingAuthority"                  => "Immigration Authority of Singapore",
                                        "documentType"                      => "NRIC/Passport Number",
                                        "validUntil"                        => "2021-09-12",
                                        "documentId"                        => "S9812345A"
                                    ]
                                ]
                            ]
                        ]);
        dd($createClient);
        if($createClient['status_code'] != 200){
            return $this->sendError('Registering Mambu client is failed. Errors : ' . json_encode(@$createClient['body']->message));
        }



        return $this->sendResponse(null, 'Mambu client created');
    }
}
