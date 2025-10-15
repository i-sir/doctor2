<?php

namespace api\wxapp\controller;

/**
 * @ApiController(
 *     "name"                    =>"DoctorFructify",
 *     "name_underline"          =>"doctor_fructify",
 *     "controller_name"         =>"DoctorFructify",
 *     "table_name"              =>"doctor_fructify",
 *     "remark"                  =>"结果管理"
 *     "api_url"                 =>"/api/wxapp/doctor_fructify/index",
 *     "author"                  =>"",
 *     "create_time"             =>"2025-10-15 11:41:49",
 *     "version"                 =>"1.0",
 *     "use"                     => new \api\wxapp\controller\DoctorFructifyController();
 *     "test_environment"        =>"http://doctor2.ikun:9090/api/wxapp/doctor_fructify/index",
 *     "official_environment"    =>"https://xcxkf203.aubye.com/api/wxapp/doctor_fructify/index",
 * )
 */


use think\facade\Db;
use think\facade\Log;
use think\facade\Cache;


error_reporting(0);


class DoctorFructifyController extends AuthController
{

    //public function initialize(){
    //	//结果管理
    //	parent::initialize();
    //}


    /**
     * 默认接口
     * /api/wxapp/doctor_fructify/index
     * https://xcxkf203.aubye.com/api/wxapp/doctor_fructify/index
     */
    public function index()
    {
        $DoctorFructifyInit  = new \init\DoctorFructifyInit();//结果管理   (ps:InitController)
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理   (ps:InitModel)

        $result = [];

        $this->success('结果管理-接口请求成功', $result);
    }


    /**
     * 结果管理 详情
     * @OA\Post(
     *     tags={"结果管理"},
     *     path="/wxapp/doctor_fructify/find_fructify",
     *
     *
     **    @OA\Parameter(
     *         name="age_id",
     *         in="query",
     *         description="患者年龄",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="weight_id",
     *         in="query",
     *         description="体重",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="past_id",
     *         in="query",
     *         description="既往史",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="allergy_id",
     *         in="query",
     *         description="过敏史",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="part_id",
     *         in="query",
     *         description="部位",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="celsius_id",
     *         in="query",
     *         description="温度",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="is_drug",
     *         in="query",
     *         description="家中是否有药:1是,2否",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="drug_id",
     *         in="query",
     *         description="退烧药",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_fructify/find_fructify
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_fructify/find_fructify
     *   api:  /wxapp/doctor_fructify/find_fructify
     *   remark_name: 结果管理 详情
     *
     */
    public function find_fructify()
    {
        $DoctorFructifyInit  = new \init\DoctorFructifyInit();//结果管理    (ps:InitController)
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        $map   = [];
        $map[] = ['id', '<>', 0];
        $map[] = ['is_show', '=', 1];
        if ($params['is_drug']) $map[] = ['is_drug', '=', $params['is_drug']];
        if ($params['part_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['part_id']},part_ids)")];
        if ($params['celsius_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['celsius_id']},celsius_ids)")];
        if ($params['age_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['age_id']},age_ids)")];
        if ($params['weight_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['weight_id']},weight_ids)")];
        if ($params['past_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['past_id']},past_ids)")];
        if ($params['allergy_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['allergy_id']},allergy_ids)")];
        if ($params['drug_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['drug_id']},drug_ids)")];


        /** 查询数据 **/
        $params["InterfaceType"] = "api";//接口类型
        $params["DataFormat"]    = "find";//数据格式,find详情,list列表
        $result                  = $DoctorFructifyInit->get_find($map, $params);
        if (empty($result)) $this->error("暂无数据");

        $this->success("详情数据", $result);
    }


    /**
     * 发热程度
     * @OA\Post(
     *     tags={"结果管理"},
     *     path="/wxapp/doctor_fructify/find_degree",
     *
     *
     *
     *    @OA\Parameter(
     *         name="part_id",
     *         in="query",
     *         description="部位",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *    @OA\Parameter(
     *         name="celsius_id",
     *         in="query",
     *         description="温度",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_fructify/find_degree
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_fructify/find_degree
     *   api:  /wxapp/doctor_fructify/find_degree
     *   remark_name: 发热程度
     *
     */
    public function find_degree()
    {
        $DoctorDegreeInit = new \init\DoctorDegreeInit();//发热程度    (ps:InitController)

        $params = $this->request->param();

        $map   = [];
        $map[] = ['id', '<>', 0];
        $map[] = ['is_show', '=', 1];
        if ($params['part_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['part_id']},part_ids)")];
        if ($params['celsius_id']) $map[] = ['', 'EXP', Db::raw("FIND_IN_SET({$params['celsius_id']},celsius_ids)")];

        $result = $DoctorDegreeInit->get_find($map);
        if (empty($result)) $this->error("暂无数据");


        $this->success("详情数据", $result);
    }

}
