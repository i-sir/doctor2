<?php

namespace api\wxapp\controller;

/**
 * @ApiController(
 *     "name"                    =>"DoctorSymptom",
 *     "name_underline"          =>"doctor_symptom",
 *     "controller_name"         =>"DoctorSymptom",
 *     "table_name"              =>"doctor_symptom",
 *     "remark"                  =>"症状管理"
 *     "api_url"                 =>"/api/wxapp/doctor_symptom/index",
 *     "author"                  =>"",
 *     "create_time"             =>"2025-10-15 16:11:44",
 *     "version"                 =>"1.0",
 *     "use"                     => new \api\wxapp\controller\DoctorSymptomController();
 *     "test_environment"        =>"http://doctor2.ikun:9090/api/wxapp/doctor_symptom/index",
 *     "official_environment"    =>"https://xcxkf203.aubye.com/api/wxapp/doctor_symptom/index",
 * )
 */


use think\facade\Db;
use think\facade\Log;
use think\facade\Cache;


error_reporting(0);


class DoctorSymptomController extends AuthController
{

    //public function initialize(){
    //	//症状管理
    //	parent::initialize();
    //}


    /**
     * 默认接口
     * /api/wxapp/doctor_symptom/index
     * https://xcxkf203.aubye.com/api/wxapp/doctor_symptom/index
     */
    public function index()
    {
        $DoctorSymptomInit  = new \init\DoctorSymptomInit();//症状管理   (ps:InitController)
        $DoctorSymptomModel = new \initmodel\DoctorSymptomModel(); //症状管理   (ps:InitModel)

        $result = [];

        $this->success('症状管理-接口请求成功', $result);
    }


    /**
     * 症状 列表
     * @OA\Post(
     *     tags={"症状管理"},
     *     path="/wxapp/doctor_symptom/find_symptom_list",
     *
     *
     *
     *
     *    @OA\Parameter(
     *         name="openid",
     *         in="query",
     *         description="openid",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="(选填)关键字搜索",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *     @OA\Parameter(
     *         name="is_paginate",
     *         in="query",
     *         description="false=分页(不传默认分页),true=不分页",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_symptom/find_symptom_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_symptom/find_symptom_list
     *   api:  /wxapp/doctor_symptom/find_symptom_list
     *   remark_name: 症状管理 列表
     *
     */
    public function find_symptom_list()
    {
        $DoctorSymptomInit  = new \init\DoctorSymptomInit();//症状管理   (ps:InitController)
        $DoctorSymptomModel = new \initmodel\DoctorSymptomModel(); //症状管理   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        /** 查询条件 **/
        $where   = [];
        $where[] = ['id', '>', 0];
        $where[] = ['is_show', '=', 1];
        if ($params["keyword"]) $where[] = ["name", "like", "%{$params['keyword']}%"];
        if ($params["status"]) $where[] = ["status", "=", $params["status"]];


        /** 查询数据 **/
        $params["InterfaceType"] = "api";//接口类型
        $params["DataFormat"]    = "list";//数据格式,find详情,list列表
        $params["field"]         = "*";//过滤字段
        if ($params['is_paginate']) $result = $DoctorSymptomInit->get_list($where, $params);
        if (empty($params['is_paginate'])) $result = $DoctorSymptomInit->get_list_paginate($where, $params);
        if (empty($result)) $this->error("暂无信息!");

        $this->success("请求成功!", $result);
    }


    /**
     * 查询结果
     * @OA\Post(
     *     tags={"症状管理"},
     *     path="/wxapp/doctor_symptom/find_value",
     *
     *
     *
     *
     *    @OA\Parameter(
     *         name="openid",
     *         in="query",
     *         description="openid",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *     @OA\Parameter(
     *         name="symptom_ids",
     *         in="query",
     *         description="数组格式",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_symptom/find_value
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_symptom/find_value
     *   api:  /wxapp/doctor_symptom/find_value
     *   remark_name: 查询结果
     *
     */
    public function find_value()
    {
        $DoctorSymptomValueInit  = new \init\DoctorSymptomValueInit();//伴随症状结果   (ps:InitController)
        $DoctorSymptomValueModel = new \initmodel\DoctorSymptomValueModel(); //伴随症状结果   (ps:InitModel)
        $params                  = $this->request->param();

        if  (!$params['symptom_ids']) $this->error("请选择症状!");

        sort($params['symptom_ids']); // 对key进行从小到大排序
        $symptom_ids = $this->setParams($params['symptom_ids']);


        $map   = [];
        $map[] = ['symptom_ids', '=', $symptom_ids];

        $result = $DoctorSymptomValueInit->get_find($map);
        if (empty($result)) $this->error("暂无信息!");
        $this->success("请求成功!", $result);
    }

}
