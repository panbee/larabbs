<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SpamDetector implements Rule
{
    private $keywords = ['习近平','胡锦涛','江泽民','邓小平','毛泽东'];

    private $methods = ['invalidKeywords','keyHeldDown'];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach($this->methods as $method){
            if(!$this->$method($value)){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '内容不符合要求!';
    }

    private function invalidKeyWords($value)
    {
        foreach($this->keywords as $invalidKeywords){
            if(strpos($value,$invalidKeywords) !== false){
                return false;
            }
        }
        return true;
    }

    private function keyHeldDown($value)
    {
        if(preg_match('/(.)\\1{4,}/',$value)){
            return false;
        }
        return true;
    }
}
