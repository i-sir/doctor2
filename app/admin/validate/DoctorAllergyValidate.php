<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorAllergy",
    *     "name_underline"   =>"doctor_allergy",
    *     "table_name"       =>"doctor_allergy",
    *     "validate_name"    =>"DoctorAllergyValidate",
    *     "remark"           =>"过敏史管理",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 10:44:06",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorAllergy);
    * )
    */

class DoctorAllergyValidate extends Validate
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
