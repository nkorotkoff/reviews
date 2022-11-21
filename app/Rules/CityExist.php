<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Http;

class CityExist implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $response = Http::accept("application/json")->withHeaders([
            "Authorization"=>"Token "  . "baeb38753a639e0f10f3bf01eda452d6014b9be4",
            "X-Secret" => '3e0edf0f0b358816fef8c66e0f1f9bbe85706bfa',
        ])->post('https://cleaner.dadata.ru/api/v1/clean/address',[$value]);
       $city = $response->collect($key = null)->pluck('result');
       if(!str_contains($city->implode('-'),ucfirst($value))){
           $fail('Не правильно введен город');
       }
    }
}
