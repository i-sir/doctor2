<?php

namespace api\wxapp\validate;

use think\Validate;


/**
    * @AdminModel(
    *     "name"             =>"BaseLeave",
    *     "name_underline"   =>"base_leave",
    *     "table_name"       =>"base_leave",
    *     "validate_name"    =>"BaseLeaveValidate",
    *     "remark"           =>"评价与建议",
    *     "author"           =>"",
    *     "create_time"      =>"2025-10-15 16:32:07",
    *     "version"          =>"1.0",
    *     "use"              =>   $this->validate($params, BaseLeave);
    * )
    */

class BaseLeaveValidate extends Validate
{

protected $rule = [];




protected $message = [];





//软删除(delete_time,0)  'action'     => 'require|unique:AdminMenu,app^controller^action,delete_time,0',


//    protected $scene = [
//        'add'  => ['name', 'app', 'controller', 'action', 'parent_id'],
//        'edit' => ['name', 'app', 'controller', 'action', 'id', 'parent_id'],
//    ];


}
