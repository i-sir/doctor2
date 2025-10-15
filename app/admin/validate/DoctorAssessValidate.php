<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorAssess",
    *     "name_underline"   =>"doctor_assess",
    *     "table_name"       =>"doctor_assess",
    *     "validate_name"    =>"DoctorAssessValidate",
    *     "remark"           =>"病情评估",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 15:21:13",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorAssess);
    * )
    */

class DoctorAssessValidate extends Validate
{

protected $rule = [];




protected $message = [];




//软删除(delete_time,0)  'action'     => 'require|unique:AdminMenu,app^controller^action,delete_time,0',

//    protected $scene = [
//        'add'  => ['name', 'app', 'controller', 'action', 'parent_id'],
//        'edit' => ['name', 'app', 'controller', 'action', 'id', 'parent_id'],
//    ];


}
