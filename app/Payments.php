<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Payments extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'payments';

    protected $fillable = [
    	'book_id', 'receive', 'verify_by',
    ];
}
