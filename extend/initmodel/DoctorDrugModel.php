<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorDrug",
    *     "name_underline"   =>"doctor_drug",
    *     "table_name"       =>"doctor_drug",
    *     "model_name"       =>"DoctorDrugModel",
    *     "remark"           =>"药物管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:44:34",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorDrugModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorDrugModel extends Model{

	protected $name = 'doctor_drug';//药物管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
