<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'project_model';

    public function data_wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah');
    }

    public function areas()
    {
        return $this->hasMany(Area::class, 'id_project');
    }

    public function data_guards()
    {
        return $this->belongsToMany(Guard::class,'pivot_guard_projects','id_guard','id_project');
    }
    
}
