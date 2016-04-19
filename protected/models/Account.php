<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/8/16
 * Time: 2:05 PM
 */
class Account extends CActiveRecord
{

    //public $role;
    //public $permissions;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "Account";
    }

    public function primaryKey() {
        return "id";
    }

    public function relations(){
        return array(
            //'role'=>array(self::HAS_ONE, 'Role', 'id'),
            'roles'=>array(self::MANY_MANY, 'Role', 'Account_Role(account_id, role_id)'),
            'permissions'=>array(self::MANY_MANY, 'Permission', 'Account_Permission(account_id, permission_id)')
        );
    }

}
