<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Rooms extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'rooms';

    protected $fillable = [
    	'name', 'status', 'price',
    ];
}
