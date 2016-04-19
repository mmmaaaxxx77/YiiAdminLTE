<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/8/16
 * Time: 2:05 PM
 */
class Account_Permission extends CActiveRecord
{



    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "Account_Permission";
    }

    public function primaryKey() {
        return array('account_id', 'permission_id');
    }

    public function relations(){
    }

}
