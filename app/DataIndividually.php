<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataIndividually extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department(){
        return $this->hasOne('App\Department', 'id', 'department_id');
    }
}
