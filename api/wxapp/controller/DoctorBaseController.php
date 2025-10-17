<?php

namespace api\wxapp\controller;

use think\facade\Db;
use think\facade\Log;
use think\facade\Cache;


error_reporting(0);

class DoctorBaseController extends AuthController
{

    /**
     * 测量部位列表
     * @OA\Post(
     *     tags={"基础配置"},
     *     path="/wxapp/doctor_base/find_part_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_base/find_part_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_base/find_part_list
     *   api:  /wxapp/doctor_base/find_part_list
     *   remark_name: 测量部位列表
     *
     */
    public function find_part_list()
    {
        $DoctorPartInit  = new \init\DoctorPartInit();//测量部位管理    (ps:InitController)

        $result = $DoctorPartInit->get_list();

        $this->success('成功', $result);
    }

    /**
     * 温度列表
     * @OA\Post(
     *     tags={"基础配置"},
     *     path="/wxapp/doctor_base/find_celsius_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_base/find_celsius_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_base/find_celsius_list
     *   api:  /wxapp/doctor_base/find_celsius_list
     *   remark_name: 温度列表
     *
     */
    public function find_celsius_list()
    {
        $DoctorCelsiusInit  = new \init\DoctorCelsiusInit();//温度管理    (ps:InitController)

        $result = $DoctorCelsiusInit->get_list();

        $this->success('成功', $result);
    }

    /**
     * 年龄列表
     * @OA\Post(
     *     tags={"基础配置"},
     *     path="/wxapp/doctor_base/find_age_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_base/find_age_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_base/find_age_list
     *   api:  /wxapp/doctor_base/find_age_list
     *   remark_name: 年龄列表
     *
     */
    public function find_age_list()
    {
        $DoctorAgeInit  = new \init\DoctorAgeInit();//年龄管理    (ps:InitController)

        $result = $DoctorAgeInit->get_list();

        $this->success('成功', $result);
    }

    /**
     * 体重列表
     * @OA\Post(
     *     tags={"基础配置"},
     *     path="/wxapp/doctor_base/find_weight_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_base/find_weight_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_base/find_weight_list
     *   api:  /wxapp/doctor_base/find_weight_list
     *   remark_name: 体重列表
     *
     */
    public function find_weight_list()
    {
        $DoctorWeightInit  = new \init\DoctorWeightInit();//体重管理    (ps:InitController)

        $result = $DoctorWeightInit->get_list();

        $this->success('成功', $result);
    }

    /**
     * 既往史列表
     * @OA\Post(
     *     tags={"基础配置"},
     *     path="/wxapp/doctor_base/find_past_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_base/find_past_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_base/find_past_list
     *   api:  /wxapp/doctor_base/find_past_list
     *   remark_name: 既往史列表
     *
     */
    public function find_past_list()
    {
        $DoctorPastInit  = new \init\DoctorPastInit();//既往史管理    (ps:InitController)

        $result = $DoctorPastInit->get_list();

        $this->success('成功', $result);
    }

    /**
     * 过敏史列表
     * @OA\Post(
     *     tags={"基础配置"},
     *     path="/wxapp/doctor_base/find_allergy_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_base/find_allergy_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_base/find_allergy_list
     *   api:  /wxapp/doctor_base/find_allergy_list
     *   remark_name: 过敏史列表
     *
     */
    public function find_allergy_list()
    {
        $DoctorAllergyInit  = new \init\DoctorAllergyInit();//过敏史管理    (ps:InitController)

        $result = $DoctorAllergyInit->get_list();

        $this->success('成功', $result);
    }

    /**
     * 药物列表
     * @OA\Post(
     *     tags={"基础配置"},
     *     path="/wxapp/doctor_base/find_drug_list",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/doctor_base/find_drug_list
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/doctor_base/find_drug_list
     *   api:  /wxapp/doctor_base/find_drug_list
     *   remark_name: 药物列表
     *
     */
    public function find_drug_list()
    {
        $DoctorDrugInit  = new \init\DoctorDrugInit();//药物管理    (ps:InitController)

        $result = $DoctorDrugInit->get_list();

        $this->success('成功', $result);
    }

}