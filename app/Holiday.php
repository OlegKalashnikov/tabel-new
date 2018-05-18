<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $guarded = [];
    public $timestamps = FALSE;

    public static function type($type){
        switch($type){
            case '1': return 'Предпраздничный день';
            case '2': return 'Праздничный день';
        }
    }
}
