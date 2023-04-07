<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutcomingVehicle extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'outcoming_vehicle';
}
