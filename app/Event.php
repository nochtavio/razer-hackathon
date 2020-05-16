<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'address',
        'price',
        'experience',
        'label',
        'located_at',
        'open_at',
        'closed_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        if($date){
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->setTimezone('GMT+8');
        }
    }

    public function getUpdatedAtAttribute($date)
    {
        if($date){
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->setTimezone('GMT+8');
        }
    }

    public function getLocatedAtAttribute($date)
    {
        if($date){
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->setTimezone('GMT+8');
        }
    }

    public function getOpenAtAttribute($date)
    {
        if($date){
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->setTimezone('GMT+8');
        }
    }
}
