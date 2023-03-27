<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->hasOne(User::class,'guard_id');
    }
    public function wilayah(){
        return $this->belongsTo(Wilayah::class,'id_wilayah');
    }
    public function area(){
        return $this->belongsTo(Area::class,'id_area');
    }
}
