<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorCelsius",
    *     "name_underline"   =>"doctor_celsius",
    *     "table_name"       =>"doctor_celsius",
    *     "model_name"       =>"DoctorCelsiusModel",
    *     "remark"           =>"温度管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:44:20",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorCelsiusModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorCelsiusModel extends Model{

	protected $name = 'doctor_celsius';//温度管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
