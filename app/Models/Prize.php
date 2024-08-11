<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relationship with Participant model
     */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * Accessor to get the awarded count
     */
    public function getAwardedAttribute()
    {
        return $this->participants()->count();
    }

    /**
     * Static method to simulate and select the next prize for a participant.
     */
    public static function nextPrize($participantNumber)
    {
        // Fetch all prizes and calculate the total probability
        $prizes = self::all();
        $totalProbability = $prizes->sum('probability');

        // If there is no valid probability, return null
        if ($totalProbability <= 0) {
            return null;
        }

        // Generate a random number within the total probability range
        $randomNumber = mt_rand(0, $totalProbability * 100) / 100;
        $cumulativeProbability = 0;

        foreach ($prizes as $prize) {
            $cumulativeProbability += $prize->probability;

            // Check if the random number falls within the current prize's range
            if ($randomNumber <= $cumulativeProbability) {
                // Create and assign the prize to a new participant
                $participant = Participant::create([
                    'name' => 'Participant ' . $participantNumber,
                    'email' => 'participant' . $participantNumber . '@example.com',
                    'prize_id' => $prize->id,
                ]);

                return $participant;
            }
        }

        return null;
    }
}
