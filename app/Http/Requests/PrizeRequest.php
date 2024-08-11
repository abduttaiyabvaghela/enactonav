<?php

namespace App\Http\Requests;

use App\Models\Prize;
use Illuminate\Foundation\Http\FormRequest;

class PrizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        {
            $totalProbability = Prize::where('id', '!=', $this->route('prize'))->sum('probability');
    
            return [
                'title' => 'required',
                'probability' => [
                    'required',
                    'numeric',
                    'min:0',
                    function($attribute, $value, $fail) use ($totalProbability) {
                        if ($totalProbability + $value > 100) {
                            $fail('The total probability exceeds 100%. Please adjust the probability.');
                        }
                    },
                ],
            ];
        }
    }
}
