<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorDegree",
    *     "name_underline"   =>"doctor_degree",
    *     "table_name"       =>"doctor_degree",
    *     "model_name"       =>"DoctorDegreeModel",
    *     "remark"           =>"发热程度",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 11:16:59",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorDegreeModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorDegreeModel extends Model{

	protected $name = 'doctor_degree';//发热程度

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
