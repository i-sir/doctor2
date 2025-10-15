<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorSymptomValue",
    *     "name_underline"   =>"doctor_symptom_value",
    *     "table_name"       =>"doctor_symptom_value",
    *     "model_name"       =>"DoctorSymptomValueModel",
    *     "remark"           =>"伴随症状结果",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 16:12:30",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorSymptomValueModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorSymptomValueModel extends Model{

	protected $name = 'doctor_symptom_value';//伴随症状结果

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
