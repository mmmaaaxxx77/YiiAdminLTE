<?php

class AccountViewModel
{
    public $id;
    public $email;
    public $name;
    public $last_update;
    public $create_date;
    public $last_login;
    public $online;
    public $image_id;

    public $image;
    public $roles;
    public $permissions;

    public static function toViewModel($data){
        $viewmodel = new AccountViewModel;
        $viewmodel->id = $data->id;
        $viewmodel->email = $data->email;
        $viewmodel->name = $data->name;
        $viewmodel->last_update = $data->last_update;
        $viewmodel->create_date = $data->create_date;
        $viewmodel->last_login = $data->last_login;
        $viewmodel->online = $data->online;
        $viewmodel->image = $data->image;
        $viewmodel->image_id = $data->image_id;
        $viewmodel->roles = $data->roles;
        $viewmodel->permissions = $data->permissions;

        return $viewmodel;
    }

    public static function toViewModels($data){
        $arr = array();
        foreach ($data as $key=>$value){
            array_push($arr, AccountViewModel::toViewModel($value));
        }
        return $arr;
    }
}