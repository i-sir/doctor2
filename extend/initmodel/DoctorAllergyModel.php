<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorAllergy",
    *     "name_underline"   =>"doctor_allergy",
    *     "table_name"       =>"doctor_allergy",
    *     "model_name"       =>"DoctorAllergyModel",
    *     "remark"           =>"过敏史管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:44:06",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorAllergyModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorAllergyModel extends Model{

	protected $name = 'doctor_allergy';//过敏史管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
