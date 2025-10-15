<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorSymptom",
    *     "name_underline"   =>"doctor_symptom",
    *     "table_name"       =>"doctor_symptom",
    *     "validate_name"    =>"DoctorSymptomValidate",
    *     "remark"           =>"症状管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 16:11:44",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorSymptom);
    * )
    */

class DoctorSymptomValidate extends Validate
{

protected $rule = ['name'=>'require',
];




protected $message = ['name.require'=>'名称不能为空!',
];




//软删除(delete_time,0)  'action'     => 'require|unique:AdminMenu,app^controller^action,delete_time,0',

//    protected $scene = [
//        'add'  => ['name', 'app', 'controller', 'action', 'parent_id'],
//        'edit' => ['name', 'app', 'controller', 'action', 'id', 'parent_id'],
//    ];


}
