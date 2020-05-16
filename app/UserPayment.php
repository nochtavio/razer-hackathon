<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserPayment extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'event_id',
        'grand_total',
        'status',
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
}
