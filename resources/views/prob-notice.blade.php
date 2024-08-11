<?php

use App\Models\Prize;

$current_probability = floatval(Prize::sum('probability'));
$remaining_probability = 100 - $current_probability;

?>

@if($current_probability < 100)
    <div class="alert alert-warning">
        <strong>Notice:</strong> The sum of all prizes' probabilities must be 100%. 
        <br>
        Currently, it is {{ $current_probability }}%,
        You need to add {{ $remaining_probability }}% more to reach 100%.
    </div>
@endif