<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Event;

use App\Http\Resources\Events\EventResource;

use Carbon\Carbon;
use DB;

class EventController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $input  = $request->all();

        $events = Event::query();

        if(@$input['category_id'] != null){
            $events->where('category_id', $input['category_id']);
        }

        $collection = EventResource::collection($events->get());

        return $this->sendResponse($collection->values()->all(), 'Events retrieved sucessfully');
    }

    public function show($id)
    {
        $event = Event::find($id);

        return $this->sendResponse(new EventResource($event), 'Event is successfully retrieved');
    }
}
