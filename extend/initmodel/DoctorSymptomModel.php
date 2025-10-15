<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorSymptom",
    *     "name_underline"   =>"doctor_symptom",
    *     "table_name"       =>"doctor_symptom",
    *     "model_name"       =>"DoctorSymptomModel",
    *     "remark"           =>"症状管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 16:11:44",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorSymptomModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorSymptomModel extends Model{

	protected $name = 'doctor_symptom';//症状管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
