<?php

class BlogPDO extends PDO
{

    public function __construct($dns, $username = null, $password = null, $type = 'sqlite')
    {
        parent::__construct($type . ':' . $dns, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }
    public function pluralize(string $word)
    {
        switch ($word) {
            case 'post':
                return 'posts';
                break;
            case 'category':
                return 'categories';
                break;
            case 'author':
                return 'authors';
                break;
            default:
                return '';
        }
    }
}
