<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorWeight",
    *     "name_underline"   =>"doctor_weight",
    *     "table_name"       =>"doctor_weight",
    *     "model_name"       =>"DoctorWeightModel",
    *     "remark"           =>"体重管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:45:05",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorWeightModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorWeightModel extends Model{

	protected $name = 'doctor_weight';//体重管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
