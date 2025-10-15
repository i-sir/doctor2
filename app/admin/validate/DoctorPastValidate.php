<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorPast",
    *     "name_underline"   =>"doctor_past",
    *     "table_name"       =>"doctor_past",
    *     "validate_name"    =>"DoctorPastValidate",
    *     "remark"           =>"既往史管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:44:51",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorPast);
    * )
    */

class DoctorPastValidate extends Validate
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
