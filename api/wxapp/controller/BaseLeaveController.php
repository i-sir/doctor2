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
     * 评价与建议 添加
     * @OA\Post(
     *     tags={"评价与建议"},
     *     path="/wxapp/base_leave/add_leave",
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
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/base_leave/add_leave
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/base_leave/add_leave
     *   api:  /wxapp/base_leave/add_leave
     *   remark_name: 评价与建议 添加
     *
     */
    public function add_leave()
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

 

}
