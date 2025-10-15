<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorFructify",
    *     "name_underline"   =>"doctor_fructify",
    *     "table_name"       =>"doctor_fructify",
    *     "model_name"       =>"DoctorFructifyModel",
    *     "remark"           =>"结果管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 11:41:49",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorFructifyModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorFructifyModel extends Model{

	protected $name = 'doctor_fructify';//结果管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
