<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combination extends Model
{
    protected $guarded = [];
    public $timestamps = FALSE;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function my_employee(){
        return $this->hasOne('App\MyEmployee', 'id', 'my_employee_id');
    }
}
