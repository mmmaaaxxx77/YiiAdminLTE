<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/20/16
 * Time: 5:28 PM
 */
class Image extends CActiveRecord{
    public $id;
    public $path;
    public $file;

    public function __construct()
    {
        parent::__construct();
    }

    public function setData($file, $id)
    {
        $this->id = $id;
        $this->file = $file;
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->saveFileToPath($this->id, '/upload/');
        }

        return parent::beforeSave();
    }

    public function tableName()
    {
        return "Image";
    }

    public function primaryKey() {
        return "id";
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function relations(){
        return array(
            'account'=>array(self::BELONGS_TO, 'Account', 'id')
        );
    }

    public function saveFileToPath($name, $path){
        $info = pathinfo($this->file['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = "$name.".$ext;
        $this->path = $path.$newname;

        $target = YiiBase::getPathOfAlias('webroot').$path.$newname;
        move_uploaded_file( $this->file['tmp_name'], $target);
    }

    public static function saveFile($file, $name, $path){
        $info = pathinfo($file['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = "$name.".$ext;

        $target = YiiBase::getPathOfAlias('webroot').$path.$newname;
        move_uploaded_file( $file['tmp_name'], $target);
    }

}