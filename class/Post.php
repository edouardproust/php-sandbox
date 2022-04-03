<?php

class Post {

    public function getDate(string $length = '')
    {
        $date = new DateTime("@" . $this->date);
        switch($length) {
            case 'long': $f = "F j, Y"; break;
            case 'short': $f = "m/d/Y"; break;
            default: $f = "M j, Y";
        }
        return $date->format("M j, Y");
    }
    public function getExerpt(bool $has_featured_image = true)
    {
        $has_featured_image ? $max_letters = 200 : $max_letters = 500;
        if(strlen($this->content) > $max_letters) {
            $exerpt = wordwrap($this->content, $max_letters, '__break__');
            $array = explode('__break__', $exerpt);
            return $array[0] . ' ...';
        } else {
            return $this->content;
        }
    }
    public static function cat_name_format(string $category_name) 
    {
        return strtolower(str_replace(['-','_',' '], '-', $category_name));
    }

}