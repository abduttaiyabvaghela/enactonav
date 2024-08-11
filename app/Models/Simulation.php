<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    use HasFactory;

    protected $fillable = ['prize_id', 'participants_count'];

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }
}
