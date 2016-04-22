<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/20/16
 * Time: 1:52 PM
 */
class CustomResult
{
    public $result;
    public $success;

    public function __construct($success, $result)
    {
        $this->success = $success;
        $this->result = $result;
    }
}