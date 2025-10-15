<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorFructify",
    *     "name_underline"   =>"doctor_fructify",
    *     "table_name"       =>"doctor_fructify",
    *     "validate_name"    =>"DoctorFructifyValidate",
    *     "remark"           =>"结果管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 11:41:49",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorFructify);
    * )
    */

class DoctorFructifyValidate extends Validate
{

protected $rule = ['name'=>'require',
];




protected $message = ['name.require'=>'备注不能为空!',
];




//软删除(delete_time,0)  'action'     => 'require|unique:AdminMenu,app^controller^action,delete_time,0',

//    protected $scene = [
//        'add'  => ['name', 'app', 'controller', 'action', 'parent_id'],
//        'edit' => ['name', 'app', 'controller', 'action', 'id', 'parent_id'],
//    ];


}
