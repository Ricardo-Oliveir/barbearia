<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['client_name', 'client_phone', 'appointment_datetime', 'available_slot_id'];

    public function availableSlot()
    {
        return $this->belongsTo(AvailableSlot::class);
    }
}
