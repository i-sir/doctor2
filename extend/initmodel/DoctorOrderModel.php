<?php

namespace initmodel;

/**
    * @AdminModel(
    *     "name"             =>"DoctorOrder",
    *     "name_underline"   =>"doctor_order",
    *     "table_name"       =>"doctor_order",
    *     "model_name"       =>"DoctorOrderModel",
    *     "remark"           =>"订单管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-16 09:42:10",
    *     "version"          =>"1.0",
    *     "use"              => new \initmodel\DoctorOrderModel();
    * )
    */


use think\facade\Db;
use think\Model;
use think\model\concern\SoftDelete;


class DoctorOrderModel extends Model{

	protected $name = 'doctor_order';//订单管理

	//软删除
	protected $hidden            = ['delete_time'];
	protected $deleteTime        = 'delete_time';
    protected $defaultSoftDelete = 0;
    use SoftDelete;
}
