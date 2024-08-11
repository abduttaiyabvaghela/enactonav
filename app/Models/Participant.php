<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['name', 'email', 'prize_id'];

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }
}
