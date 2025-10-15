<?php

namespace api\wxapp\controller;

/**
 * @ApiController(
 *     "name"                    =>"DoctorAssess",
 *     "name_underline"          =>"doctor_assess",
 *     "controller_name"         =>"DoctorAssess",
 *     "table_name"              =>"doctor_assess",
 *     "remark"                  =>"病情评估"
 *     "api_url"                 =>"/api/wxapp/doctor_assess/index",
 *     "author"                  =>"",
 *     "create_time"             =>"2025-10-15 15:21:13",
 *     "version"                 =>"1.0",
 *     "use"                     => new \api\wxapp\controller\DoctorAssessController();
 *     "test_environment"        =>"http://doctor2.ikun:9090/api/wxapp/doctor_assess/index",
 *     "official_environment"    =>"https://xcxkf203.aubye.com/api/wxapp/doctor_assess/index",
 * )
 */


use think\facade\Db;
use think\facade\Log;
use think\facade\Cache;


error_reporting(0);


class DoctorAssessController extends AuthController
{

    //public function initialize(){
    //	//病情评估
    //	parent::initialize();
    //}


    /**
     * 默认接口
     * /api/wxapp/doctor_assess/index
     * https://xcxkf203.aubye.com/api/wxapp/doctor_assess/index
     */
    public function index()
    {
        $DoctorAssessInit  = new \init\DoctorAssessInit();//病情评估   (ps:InitController)
        $DoctorAssessModel = new \initmodel\DoctorAssessModel(); //病情评估   (ps:InitModel)

        $result = [];

        $this->success('病情评估-接口请求成功', $result);
    }


    /**
     * 病情评估 详情
     * @OA\Post(
     *     tags={"病情评估"},
     *     path="/wxapp/doctor_assess/find_assess",
     *
     *
     *
     *    @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="名称:发热病程,精神状态....",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *    @OA\Parameter(
     *         name="value",
     *         in="query",
     *         description="结果值   ",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_assess/find_assess
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_assess/find_assess
     *   api:  /wxapp/doctor_assess/find_assess
     *   remark_name: 病情评估 详情
     *
     */
    public function find_assess()
    {
        $DoctorAssessInit  = new \init\DoctorAssessInit();//病情评估    (ps:InitController)
        $DoctorAssessModel = new \initmodel\DoctorAssessModel(); //病情评估   (ps:InitModel)

        /** 获取参数 **/
        $params = $this->request->param();

        if (empty($params["name"]) || empty($params["value"])) $this->error("参数错误");


        $in_name = ['发热病程', '精神状态', '呼吸情况', '饮食情况', '其他'];
        $eq_name = ['体温峰值'];

        /** 查询条件 **/
        $where = [];


        // 等于
        if (in_array($params["name"], $eq_name)) {
            $where[] = ["name", "=", $params["name"]];
            $where[] = ["value", "=", $params["value"]];
        }

        //范围
        if (in_array($params["name"], $in_name)) {
            $where[] = ["name", "=", $params["name"]];
            $where[] = ['value', 'like', "%/{$params['value']}/%"];
        }

        /** 查询数据 **/
        $params["InterfaceType"] = "api";//接口类型
        $params["DataFormat"]    = "find";//数据格式,find详情,list列表
        $result                  = $DoctorAssessInit->get_find($where, $params);
        if (empty($result)) $this->error("暂无数据");

        $this->success("详情数据", $result);
    }


}
