<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function project(){
        return $this->belongsTo(ProjectModel::class,'id_project');
    }
    public function data_guards(){
        return $this->hasMany(Area::class,'id_area');
    }
}
