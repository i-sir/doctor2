<?php

namespace api\wxapp\controller;

/**
 * @ApiController(
 *     "name"                    =>"BaseLeave",
 *     "name_underline"          =>"base_leave",
 *     "controller_name"         =>"BaseLeave",
 *     "table_name"              =>"base_leave",
 *     "remark"                  =>"评价与建议"
 *     "api_url"                 =>"/api/wxapp/base_leave/index",
 *     "author"                  =>"",
 *     "create_time"             =>"2025-10-15 16:32:07",
 *     "version"                 =>"1.0",
 *     "use"                     => new \api\wxapp\controller\BaseLeaveController();
 *     "test_environment"        =>"http://doctor2.ikun:9090/api/wxapp/base_leave/index",
 *     "official_environment"    =>"https://xcxkf203.aubye.com/api/wxapp/base_leave/index",
 * )
 */


use think\facade\Db;
use think\facade\Log;
use think\facade\Cache;


error_reporting(0);


class BaseLeaveController extends AuthController
{

    //public function initialize(){
    //	//评价与建议
    //	parent::initialize();
    //}


    /**
     * 默认接口
     * /api/wxapp/base_leave/index
     * https://xcxkf203.aubye.com/api/wxapp/base_leave/index
     */
    public function index()
    {
        $BaseLeaveInit  = new \init\BaseLeaveInit();//评价与建议   (ps:InitController)
        $BaseLeaveModel = new \initmodel\BaseLeaveModel(); //评价与建议   (ps:InitModel)

        $result = [];

        $this->success('评价与建议-接口请求成功', $result);
    }


    /**
     * 评价与建议 列表
     * @OA\Post(
     *     tags={"评价与建议"},
     *     path="/wxapp/base_leave/find_base_leave_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/base_leave/find_base_leave_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/base_leave/find_base_leave_list
     *   api:  /wxapp/base_leave/find_base_leave_list
     *   remark_name: 评价与建议 列表
     *
     */
    public function find_base_leave_list()
    {
        $BaseLeaveInit  = new \init\BaseLeaveInit();//评价与建议   (ps:InitController)
        $BaseLeaveModel = new \initmodel\BaseLeaveModel(); //评价与建议   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        /** 查询条件 **/
        $where   = [];
        $where[] = ['id', '>', 0];

        if ($params["keyword"]) $where[] = ["satisfaction|content", "like", "%{$params['keyword']}%"];
        if ($params["status"]) $where[] = ["status", "=", $params["status"]];


        /** 查询数据 **/
        $params["InterfaceType"] = "api";//接口类型
        $params["DataFormat"]    = "list";//数据格式,find详情,list列表
        $params["field"]         = "*";//过滤字段
        if ($params['is_paginate']) $result = $BaseLeaveInit->get_list($where, $params);
        if (empty($params['is_paginate'])) $result = $BaseLeaveInit->get_list_paginate($where, $params);
        if (empty($result)) $this->error("暂无信息!");

        $this->success("请求成功!", $result);
    }


    /**
     * 评价与建议 详情
     * @OA\Post(
     *     tags={"评价与建议"},
     *     path="/wxapp/base_leave/find_base_leave",
     *
     *
     *
     *    @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="id",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/base_leave/find_base_leave
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/base_leave/find_base_leave
     *   api:  /wxapp/base_leave/find_base_leave
     *   remark_name: 评价与建议 详情
     *
     */
    public function find_base_leave()
    {
        $BaseLeaveInit  = new \init\BaseLeaveInit();//评价与建议    (ps:InitController)
        $BaseLeaveModel = new \initmodel\BaseLeaveModel(); //评价与建议   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        /** 查询条件 **/
        $where   = [];
        $where[] = ["id", "=", $params["id"]];

        /** 查询数据 **/
        $params["InterfaceType"] = "api";//接口类型
        $params["DataFormat"]    = "find";//数据格式,find详情,list列表
        $result                  = $BaseLeaveInit->get_find($where, $params);
        if (empty($result)) $this->error("暂无数据");

        $this->success("详情数据", $result);
    }


    /**
     * 评价与建议 编辑&添加
     * @OA\Post(
     *     tags={"评价与建议"},
     *     path="/wxapp/base_leave/edit_base_leave",
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
     *    @OA\Parameter(
     *         name="satisfaction",
     *         in="query",
     *         description="满意程度",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *    @OA\Parameter(
     *         name="content",
     *         in="query",
     *         description="建议",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *    @OA\Parameter(
     *         name="image",
     *         in="query",
     *         description="图片",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *    @OA\Parameter(
     *         name="video",
     *         in="query",
     *         description="视频",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *    @OA\Parameter(
     *         name="audio_file",
     *         in="query",
     *         description="录音",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *
     *    @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="id空添加,存在编辑",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/base_leave/edit_base_leave
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/base_leave/edit_base_leave
     *   api:  /wxapp/base_leave/edit_base_leave
     *   remark_name: 评价与建议 编辑&添加
     *
     */
    public function edit_base_leave()
    {
        $BaseLeaveInit  = new \init\BaseLeaveInit();//评价与建议    (ps:InitController)
        $BaseLeaveModel = new \initmodel\BaseLeaveModel(); //评价与建议   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        /** 检测参数信息 **/
        $validateResult = $this->validate($params, 'BaseLeave');
        if ($validateResult !== true) $this->error($validateResult);

        /** 更改数据条件 && 或$params中存在id本字段可以忽略 **/
        $where = [];
        if ($params['id']) $where[] = ['id', '=', $params['id']];


        /** 提交更新 **/
        $result = $BaseLeaveInit->api_edit_post($params, $where);
        if (empty($result)) $this->error("失败请重试");


        if (empty($params["id"])) $msg = "添加成功";
        if (!empty($params["id"])) $msg = "编辑成功";
        $this->success($msg);
    }


    /**
     * 评价与建议 删除
     * @OA\Post(
     *     tags={"评价与建议"},
     *     path="/wxapp/base_leave/delete_base_leave",
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
     *    @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="id",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/base_leave/delete_base_leave
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/base_leave/delete_base_leave
     *   api:  /wxapp/base_leave/delete_base_leave
     *   remark_name: 评价与建议 删除
     *
     */
    public function delete_base_leave()
    {
        $BaseLeaveInit  = new \init\BaseLeaveInit();//评价与建议    (ps:InitController)
        $BaseLeaveModel = new \initmodel\BaseLeaveModel(); //评价与建议   (ps:InitModel)

        /** 获取参数 **/
        $params = $this->request->param();

        /** 删除数据 **/
        $result = $BaseLeaveInit->delete_post($params["id"]);
        if (empty($result)) $this->error("失败请重试");

        $this->success("删除成功");
    }


}
