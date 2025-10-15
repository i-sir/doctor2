<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorSymptomValue",
    *     "name_underline"   =>"doctor_symptom_value",
    *     "table_name"       =>"doctor_symptom_value",
    *     "validate_name"    =>"DoctorSymptomValueValidate",
    *     "remark"           =>"伴随症状结果",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 16:12:30",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorSymptomValue);
    * )
    */

class DoctorSymptomValueValidate extends Validate
{

protected $rule = ['value'=>'require',
];




protected $message = ['value.require'=>'诊断结果不能为空!',
];




//软删除(delete_time,0)  'action'     => 'require|unique:AdminMenu,app^controller^action,delete_time,0',

//    protected $scene = [
//        'add'  => ['name', 'app', 'controller', 'action', 'parent_id'],
//        'edit' => ['name', 'app', 'controller', 'action', 'id', 'parent_id'],
//    ];


}
