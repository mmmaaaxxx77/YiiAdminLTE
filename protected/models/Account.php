<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/8/16
 * Time: 2:05 PM
 */
class Account extends CActiveRecord
{

    public $id;
    public $email;
    public $name;
    public $password;
    public $last_update;
    public $create_date;
    public $last_login;
    public $online;
    public $image_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->id = Yii::app()->db->createCommand('select UUID()')->queryScalar();
            $this->create_date = new CDbExpression('NOW()');
            //$this->last_login = new CDbExpression('NOW()');
            $this->online = 0;
        }

        $this->last_update = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "Account";
    }

    public function primaryKey() {
        return 'id';
    }

    public function relations(){
        return array(
            //'role'=>array(self::HAS_ONE, 'Role', 'id'),
            'roles'=>array(self::MANY_MANY, 'Role', 'Account_Role(account_id, role_id)'),
            'permissions'=>array(self::MANY_MANY, 'Permission', 'Account_Permission(account_id, permission_id)'),
            'image'=>array(self::HAS_ONE, 'Image', 'id')
        );
    }

}
