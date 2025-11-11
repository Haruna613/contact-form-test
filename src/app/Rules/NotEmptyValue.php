<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotEmptyValue implements Rule
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
        return $value !== '';
    }

    public function message()
    {
        return '選択肢を選んでください';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
}
