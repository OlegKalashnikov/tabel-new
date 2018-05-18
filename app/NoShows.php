<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoShows extends Model
{
    protected $guarded = [];
    public $timestamps = FALSE;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function my_employee(){
        return $this->hasOne('App\MyEmployee', 'id', 'my_employee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function defaulttype(){
        return $this->hasOne('App\DefaultType', 'id', 'default_type_id');
    }
}
