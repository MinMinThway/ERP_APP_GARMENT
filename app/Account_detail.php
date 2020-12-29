<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_detail extends Model
{
    //
    protected $fillable = [
    	'date','income','outcome','account_id',
    ];
}
