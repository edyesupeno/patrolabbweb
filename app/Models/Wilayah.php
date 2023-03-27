<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function areas(){
        return $this->hasMany(Area::class,'id_wilayah');
    }

    public function projects()
    {
        return $this->hasMany(ProjectModel::class, 'wilayah');
    }

    public function data_guards(){
        return $this->hasMany(Guard::class,'id_wilayah');
    }
}

