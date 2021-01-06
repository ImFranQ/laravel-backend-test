<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HeavyPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $number = false;
        $special = false;
        $uppercase = false;

        foreach (str_split($value) as $char) {
            if(!$number) $number = preg_match('/\d/', $char) > 0;
            if(!$special) $special = preg_match('/[!¡*$%\?\¿\(\)]/', $char) > 0;
            if(!$uppercase) $uppercase = preg_match('/[ABCDEFGHIJKLMNÑOPQRSTUVWXYZ]/', $char) > 0;
        }

        return $number && $special && $uppercase;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The password requires a number, an special character and an uppercase letter';
    }
}
