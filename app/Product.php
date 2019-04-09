<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function setCategoryAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['category_id'] = Category::where('category', $value)->firstOrFail()->id;
        } else $this->attributes['category_id'] = $value;
    }

    public function setImageAttribute($value)
    {
        if (is_string($value)) {
            Storage::disk('public')->putFile('avatars', $value);
        } else $this->attributes['image'] = Storage::disk('public')->putFile('avatars', $value);
    }
}
