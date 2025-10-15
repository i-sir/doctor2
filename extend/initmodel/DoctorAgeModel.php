<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorAge",
    *     "name_underline"   =>"doctor_age",
    *     "table_name"       =>"doctor_age",
    *     "model_name"       =>"DoctorAgeModel",
    *     "remark"           =>"年龄管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:43:51",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorAgeModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorAgeModel extends Model{

	protected $name = 'doctor_age';//年龄管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
