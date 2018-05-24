<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = [];
    public $timestamps = FALSE;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(){
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
