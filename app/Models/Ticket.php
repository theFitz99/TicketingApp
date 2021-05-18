<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function contact() {
        return $this->belongsTo(Contacts::class);
    }

    public function ticket_type() {
       return $this->belongsTo(Ticket_type::class, 'type_id');
    }
}
