<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserCategory extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'level',
        'experience'
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
