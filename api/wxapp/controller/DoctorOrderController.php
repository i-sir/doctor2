<?php

namespace api\wxapp\controller;

/**
 * @ApiController(
 *     "name"                    =>"DoctorOrder",
 *     "name_underline"          =>"doctor_order",
 *     "controller_name"         =>"DoctorOrder",
 *     "table_name"              =>"doctor_order",
 *     "remark"                  =>"订单管理"
 *     "api_url"                 =>"/api/wxapp/doctor_order/index",
 *     "author"                  =>"",
 *     "create_time"             =>"2025-10-16 09:42:09",
 *     "version"                 =>"1.0",
 *     "use"                     => new \api\wxapp\controller\DoctorOrderController();
 *     "test_environment"        =>"http://doctor2.ikun:9090/api/wxapp/doctor_order/index",
 *     "official_environment"    =>"https://xcxkf203.aubye.com/api/wxapp/doctor_order/index",
 * )
 */


use think\facade\Db;
use think\facade\Log;
use think\facade\Cache;


error_reporting(0);


class DoctorOrderController extends AuthController
{

    //public function initialize(){
    //	//订单管理
    //	parent::initialize();
    //}


    /**
     * 默认接口
     * /api/wxapp/doctor_order/index
     * https://xcxkf203.aubye.com/api/wxapp/doctor_order/index
     */
    public function index()
    {
        $DoctorOrderInit  = new \init\DoctorOrderInit();//订单管理   (ps:InitController)
        $DoctorOrderModel = new \initmodel\DoctorOrderModel(); //订单管理   (ps:InitModel)

        $result = [];

        $this->success('订单管理-接口请求成功', $result);
    }


    /**
     * 订单管理 详情
     * @OA\Post(
     *     tags={"订单管理"},
     *     path="/wxapp/doctor_order/find_order",
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
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_order/find_order
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_order/find_order
     *   api:  /wxapp/doctor_order/find_order
     *   remark_name: 订单管理 详情
     *
     */
    public function find_order()
    {
        $this->checkAuth();
        $DoctorOrderInit  = new \init\DoctorOrderInit();//订单管理    (ps:InitController)
        $DoctorOrderModel = new \initmodel\DoctorOrderModel(); //订单管理   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        /** 查询条件 **/
        $where   = [];
        $where[] = ["user_id", "=", $this->user_id];
        $where[] = ["status", "=", 2];
        $where[] = ["end_time", ">", time()];

        /** 查询数据 **/
        $params["InterfaceType"] = "api";//接口类型
        $params["DataFormat"]    = "find";//数据格式,find详情,list列表
        $result                  = $DoctorOrderInit->get_find($where, $params);
        if (empty($result)) $this->error("暂无数据");

        $this->success("详情数据", $result);
    }


    /**
     * 下单支付
     * @OA\Post(
     *     tags={"订单管理"},
     *     path="/wxapp/doctor_order/add_order",
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
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="default", description="An example resource")
     * )
     *
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_order/add_order
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_order/add_order
     *   api:  /wxapp/doctor_order/add_order
     *   remark_name: 下单支付
     *
     */
    public function add_order()
    {
        $this->checkAuth();
        $DoctorOrderInit  = new \init\DoctorOrderInit();//订单管理    (ps:InitController)
        $DoctorOrderModel = new \initmodel\DoctorOrderModel(); //订单管理   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        $order_num           = $this->get_num_only();
        $params['order_num'] = $order_num;


        $valid_duration     = cmf_config('valid_duration');//咨询有效时长(小时)
        $params['end_time'] = time() + ($valid_duration * 60 * 60);


        $consultation_fee = cmf_config('consultation_fee');//咨询费用
        $params['amount'] = $consultation_fee;


        /** 更改数据条件 && 或$params中存在id本字段可以忽略 **/
        $where = [];
        if ($params['id']) $where[] = ['id', '=', $params['id']];


        /** 提交更新 **/
        $result = $DoctorOrderInit->api_edit_post($params, $where);
        if (empty($result)) $this->error("失败请重试");


        $this->success('下单成功,请支付', ['order_num' => $order_num, 'order_type' => 10]);
    }


    /**
     * 编辑订单
     * @OA\Post(
     *     tags={"订单管理"},
     *     path="/wxapp/doctor_order/edit_order",
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
     *    @OA\Parameter(
     *         name="age_id",
     *         in="query",
     *         description="患者年龄",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
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
     *
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
     *
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
     *
     *
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_order/edit_order
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_order/edit_order
     *   api:  /wxapp/doctor_order/edit_order
     *   remark_name: 订单管理 编辑
     *
     */
    public function edit_order()
    {
        $this->checkAuth();
        $DoctorOrderInit  = new \init\DoctorOrderInit();//订单管理    (ps:InitController)
        $DoctorOrderModel = new \initmodel\DoctorOrderModel(); //订单管理   (ps:InitModel)

        /** 获取参数 **/
        $params            = $this->request->param();
        $params["user_id"] = $this->user_id;

        /** 检测参数信息 **/
        $validateResult = $this->validate($params, 'DoctorOrder');
        if ($validateResult !== true) $this->error($validateResult);

        /** 更改数据条件 && 或$params中存在id本字段可以忽略 **/
        $where = [];
        if ($params['id']) $where[] = ['id', '=', $params['id']];


        /** 提交更新 **/
        $result = $DoctorOrderInit->api_edit_post($params, $where);
        if (empty($result)) $this->error("失败请重试");


        if (empty($params["id"])) $msg = "添加成功";
        if (!empty($params["id"])) $msg = "编辑成功";
        $this->success($msg);
    }


}
