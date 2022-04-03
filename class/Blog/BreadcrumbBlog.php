<?php

class BreadcrumbBlog
{
    private const LAST_PART_LENGTH = 30; // Letters
    private const DELIMITER = '>';

    public function __construct(array $steps, string $current_page_title)
    {
        $this->steps = $steps;
        $this->current_page_title = $current_page_title;
    }

    public function show_breadcrumb()
    {
        $steps = '';
        foreach ($this->steps as $bc_title => $bc_link) {
            $steps .= '<a href="' . $bc_link . '">' . $bc_title . '</a> ' . self::DELIMITER . ' ';
        }
        $last_step = $this->get_bc_exerpt();
        return $steps . $last_step;
    }

    private function get_bc_exerpt()
    {
        if (strlen($this->current_page_title) > 30) {
            $exerpt = wordwrap($this->current_page_title, self::LAST_PART_LENGTH, '__break__');
            $array = explode('__break__', $exerpt);
            return ucfirst($array[0]) . ' ...';
        } else {
            return $this->current_page_title;
        }
    }
}
