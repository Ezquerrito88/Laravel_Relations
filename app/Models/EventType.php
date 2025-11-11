<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $events
 */
class EventType extends Model
{
    protected $fillable = ['description'];
    public function events(){
        return $this->hasMany('App\Models\Event');
    }
}
