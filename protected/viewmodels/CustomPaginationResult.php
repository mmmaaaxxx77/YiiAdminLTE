<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/20/16
 * Time: 1:52 PM
 */
class CustomPaginationResult
{
    public $result;
    public $success;
    public $totalPages;

    public function __construct($success, $totalPages, $result)
    {
        $this->success = $success;
        $this->result = $result;
        $this->totalPages = $totalPages;
    }
}