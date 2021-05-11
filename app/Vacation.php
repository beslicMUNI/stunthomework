<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    //
    protected $fillable = ['date_from', 'date_to', 'userid'];

    public function user(){
         return $this->belongsTo(User::class, 'userid');
    }
}
