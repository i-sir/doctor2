<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorPast",
    *     "name_underline"   =>"doctor_past",
    *     "table_name"       =>"doctor_past",
    *     "model_name"       =>"DoctorPastModel",
    *     "remark"           =>"既往史管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:44:51",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorPastModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorPastModel extends Model{

	protected $name = 'doctor_past';//既往史管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
