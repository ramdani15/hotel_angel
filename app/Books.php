<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Books extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'books';

    protected $fillable = [
    	'room_id', 'customer_id', 'date', 'paid',
    ];
}
