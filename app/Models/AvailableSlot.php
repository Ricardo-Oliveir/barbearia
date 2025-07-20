<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableSlot extends Model
{
    protected $fillable = ['slot_datetime'];

    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'available_slot_id');
    }
}
