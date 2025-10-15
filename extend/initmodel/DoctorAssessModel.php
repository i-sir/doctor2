<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorAssess",
    *     "name_underline"   =>"doctor_assess",
    *     "table_name"       =>"doctor_assess",
    *     "model_name"       =>"DoctorAssessModel",
    *     "remark"           =>"病情评估",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 15:21:13",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorAssessModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorAssessModel extends Model{

	protected $name = 'doctor_assess';//病情评估

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
