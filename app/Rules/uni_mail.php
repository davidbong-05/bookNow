<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class uni_mail implements Rule, DataAwareRule
{
    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;

        return $this;
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
        $staff_pattern = '/([a-zA-Z0-9]+)([\.{1}])?([a-zA-Z0-9]+)*@unimas.my/i';
        $student_pattern = '/^([0-9]{5}+)*@siswa.unimas.my/i';

        if ($this->data['role'] == 'Staff') {
            return preg_match($staff_pattern, $value);
        } else if ($this->data['role'] == 'Student') {
            return preg_match($student_pattern, $value);
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Staff and student must use UNIMAS official email.';
    }
}