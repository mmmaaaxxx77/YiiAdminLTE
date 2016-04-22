<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/8/16
 * Time: 2:05 PM
 */
class Account_Role extends CActiveRecord
{
    public $account_id;
    public $role_id;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "Account_Role";
    }

    public function primaryKey() {
        return array('account_id', 'role_id');
    }

}
