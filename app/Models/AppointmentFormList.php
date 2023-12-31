<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentFormList extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['appointment_day'];
}
