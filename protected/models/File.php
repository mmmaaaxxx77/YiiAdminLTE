<?php

/**
 * Created by PhpStorm.
 * User: johnnytsai
 * Date: 4/20/16
 * Time: 5:28 PM
 */
class File extends CActiveRecord{
    public $id;
    public $path;
    public $file;

    public function __construct()
    {
        parent::__construct();
    }

    public function __construct2($file)
    {
        $this->file = $file;
        parent::__construct();
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->id = Yii::app()->db->createCommand('select UUID()')->queryScalar();
            $this->saveFileToPath($this->id, '/upload/');
        }

        return parent::beforeSave();
    }

    public function tableName()
    {
        return "File";
    }

    public function primaryKey() {
        return "id";
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