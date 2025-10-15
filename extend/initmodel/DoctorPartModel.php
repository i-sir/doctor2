<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorPart",
    *     "name_underline"   =>"doctor_part",
    *     "table_name"       =>"doctor_part",
    *     "model_name"       =>"DoctorPartModel",
    *     "remark"           =>"测量部位",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 11:16:14",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorPartModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorPartModel extends Model{

	protected $name = 'doctor_part';//测量部位

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
