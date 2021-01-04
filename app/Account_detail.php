<?php

namespace App;
use App\Account;
use Illuminate\Database\Eloquent\Model;

class Account_detail extends Model
{
    //
    protected $fillable = [
    	'date','income','outcome','tranbalance','account_id',
    ];

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
