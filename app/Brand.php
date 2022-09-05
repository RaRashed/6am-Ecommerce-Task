<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $fillable =[
    	'name  '

    	];

    	 public function products(){
    	return- $this->hasMany(Category::class);
    }
}
