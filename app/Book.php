<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function author() {
        return $this->belongsTo('App\Author');
    }
}
