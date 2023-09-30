<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'guards';

    public function user(){
        return $this->hasOne(User::class,'guard_id');
    }
    public function wilayah(){
        return $this->belongsTo(Wilayah::class,'id_wilayah');
    }
    public function area(){
        return $this->belongsTo(Area::class,'id_area');
    }
    public function projects()
    {
        return $this->belongsToMany(ProjectModel::class,'pivot_guard_projects','id_guard','id_project');
    }

    protected $with = ['projects'];

    public function selfpatrols()
    {
        return $this->hasMany(SelfPatrol::class, 'id_guard');
    }
}
