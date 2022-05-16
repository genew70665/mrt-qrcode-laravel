<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;

class ValidatePassword implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return \Hash::check($value, Auth::user()->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Oops! The current password entered is incorrect.';
    }
}
