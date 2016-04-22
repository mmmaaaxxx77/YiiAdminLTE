<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/8/16
 * Time: 2:05 PM
 */
class Permission extends CActiveRecord
{

    public $id;
    public $codename;
    public $name;

    public function __construct()
    {
        parent::__construct();
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->id = Yii::app()->db->createCommand('select UUID()')->queryScalar();
        }
        return parent::beforeSave();
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "Permission";
    }

    public function primaryKey() {
        return "id";
    }

    public function relations(){
        return array(
            'account'=>array(self::BELONGS_TO, 'Account', 'per_look_id')
        );
    }

}
