<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorPart",
    *     "name_underline"   =>"doctor_part",
    *     "table_name"       =>"doctor_part",
    *     "validate_name"    =>"DoctorPartValidate",
    *     "remark"           =>"测量部位",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 11:16:14",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorPart);
    * )
    */

class DoctorPartValidate extends Validate
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
