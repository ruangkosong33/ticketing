<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entrance extends Model
{
    use HasFactory, Sluggable;

    protected $table='entrances';

    protected $fillable=['title', 'slug', 'category_id', 'priority_id', 'date', 'status', 'description'];

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
}
