<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrance extends Model
{
    use HasFactory, Sluggable;

    protected $table='entrances';

    protected $fillable=['title', 'slug', 'category_id', 'priority_id', 'date', 'status', 'description', 'user_id'];

    protected $hidden=[];

     //SLUG
     public function sluggable(): array
     {
         return [
             'slug' => [
                 'source' => 'title',
             ]
         ];
     }

     //RELATION
     public function category()
     {
         return $this->belongsTo(Category::class, 'category_id', 'id');
     }

     public function priority()
     {
         return $this->belongsTo(Priority::class, 'priority_id', 'id');
     }

     public function user()
     {
         return $this->belongsTo(User::class, 'user_id', 'id');
     }
}
