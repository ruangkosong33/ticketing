<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vps extends Model
{
    use HasFactory, Sluggable;

    protected $table='vpss';

    protected $fillable=['title', 'slug', 'recruitment', 'date', 'ip', 'storage', 'core', 'ram', 'os', 'port', 'database'];

    protected $hidden=[];

    //SLUG
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
