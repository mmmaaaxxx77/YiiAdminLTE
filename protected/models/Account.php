<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/8/16
 * Time: 2:05 PM
 */
class Account extends CActiveRecord
{



    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "account";
    }

}
