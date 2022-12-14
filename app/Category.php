<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [

        'name','category_id'

    ];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function childrenCategories()
{
    return $this->hasMany(Category::class)->with('categories');
}
      public function products(){
        return $this->hasMany(Product::class);
    }

















   /*
    public static function ParentOrNotCategory($parent_id,$child_id){
    	$categories = Category::where('id',$child_id)->where('parent_id',$parent_id)->get();
    	if(!is_null($categories)){
    		return true;
    	}else{
    		return false;
    	}
    }
    */
}

