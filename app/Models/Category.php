<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Category extends Model
{
    protected $fillable = [
        'name','description'
    ];

    public $cache_key = 'larabbs_categories';

    protected $cache_expire_in_minutes = 60 * 24 *365;

    public function getAllCached()
    {
        return Cache::remember($this->cache_key,$this->cache_expire_in_minutes,function(){
            return $this->all();
        });
    }
}
