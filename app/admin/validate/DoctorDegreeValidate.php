<?php

namespace app\admin\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"DoctorDegree",
    *     "name_underline"   =>"doctor_degree",
    *     "table_name"       =>"doctor_degree",
    *     "validate_name"    =>"DoctorDegreeValidate",
    *     "remark"           =>"发热程度",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 11:16:59",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, DoctorDegree);
    * )
    */

class DoctorDegreeValidate extends Validate
{

protected $rule = ['degree'=>'require',
'proposal'=>'require',
];




protected $message = ['degree.require'=>'发热程度不能为空!',
'proposal.require'=>'处理建议不能为空!',
];




//软删除(delete_time,0)  'action'     => 'require|unique:AdminMenu,app^controller^action,delete_time,0',

//    protected $scene = [
//        'add'  => ['name', 'app', 'controller', 'action', 'parent_id'],
//        'edit' => ['name', 'app', 'controller', 'action', 'id', 'parent_id'],
//    ];


}
