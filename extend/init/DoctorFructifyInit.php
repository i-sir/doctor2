<?php

namespace init;


/**
 * @Init(
 *     "name"            =>"DoctorFructify",
 *     "name_underline"  =>"doctor_fructify",
 *     "table_name"      =>"doctor_fructify",
 *     "model_name"      =>"DoctorFructifyModel",
 *     "remark"          =>"结果管理",
 *     "author"          =>"",
 *     "create_time"     =>"2025-10-15 11:41:49",
 *     "version"         =>"1.0",
 *     "use"             => new \init\DoctorFructifyInit();
 * )
 */

use think\facade\Db;
use app\admin\controller\ExcelController;


class DoctorFructifyInit extends Base
{
    public $is_drug = [1 => '是', 2 => '否'];

    protected $Field         = "*";//过滤字段,默认全部
    protected $Limit         = 100000;//如不分页,展示条数
    protected $PageSize      = 15;//分页每页,数据条数
    protected $Order         = "list_order,id desc";//排序
    protected $InterfaceType = "api";//接口类型:admin=后台,api=前端
    protected $DataFormat    = "find";//数据格式,find详情,list列表

    //本init和model
    public function _init()
    {
        $DoctorFructifyInit  = new \init\DoctorFructifyInit();//结果管理   (ps:InitController)
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)
    }

    /**
     * 处理公共数据
     * @param array $item   单条数据
     * @param array $params 参数
     * @return array|mixed
     */
    public function common_item($item = [], $params = [])
    {
        $DoctorPartModel    = new \initmodel\DoctorPartModel(); //测量部位  (ps:InitModel)
        $DoctorCelsiusModel = new \initmodel\DoctorCelsiusModel(); //温度管理  (ps:InitModel)
        $DoctorAgeModel     = new \initmodel\DoctorAgeModel(); //年龄管理  (ps:InitModel)
        $DoctorWeightModel  = new \initmodel\DoctorWeightModel(); //体重管理  (ps:InitModel)
        $DoctorPastModel    = new \initmodel\DoctorPastModel(); //既往史管理  (ps:InitModel)
        $DoctorAllergyModel = new \initmodel\DoctorAllergyModel(); //过敏史管理  (ps:InitModel)
        $DoctorDrugModel    = new \initmodel\DoctorDrugModel(); //药物管理  (ps:InitModel)


        //接口类型
        if ($params['InterfaceType']) $this->InterfaceType = $params['InterfaceType'];
        //数据格式
        if ($params['DataFormat']) $this->DataFormat = $params['DataFormat'];


        /** 数据格式(公共部分),find详情&&list列表 共存数据 **/
        //患者年龄
        if ($item['age_ids']) {
            $age_ids               = $this->getParams($item['age_ids']);
            $age_names             = $DoctorAgeModel->where('id', 'in', $age_ids)->column('name');
            $item['age_names']     = $this->setParams($age_names);
            $item['age_name_list'] = $age_names;
            $item['age_ids']       = $age_ids;
        }

        //体重
        if ($item['weight_ids']) {
            $weight_ids               = $this->getParams($item['weight_ids']);
            $weight_names             = $DoctorWeightModel->where('id', 'in', $weight_ids)->column('name');
            $item['weight_names']     = $this->setParams($weight_names);
            $item['weight_name_list'] = $weight_names;
            $item['weight_ids']       = $weight_ids;
        }

        //既往史
        if ($item['past_ids']) {
            $past_ids               = $this->getParams($item['past_ids']);
            $past_names             = $DoctorPastModel->where('id', 'in', $past_ids)->column('name');
            $item['past_names']     = $this->setParams($past_names);
            $item['past_name_list'] = $past_names;
            $item['past_ids']       = $past_ids;
        }

        //过敏史
        if ($item['allergy_ids']) {
            $allergy_ids               = $this->getParams($item['allergy_ids']);
            $allergy_names             = $DoctorAllergyModel->where('id', 'in', $allergy_ids)->column('name');
            $item['allergy_names']     = $this->setParams($allergy_names);
            $item['allergy_name_list'] = $allergy_names;
            $item['allergy_ids']       = $allergy_ids;
        }

        //温度
        if ($item['celsius_ids']) {
            $celsius_ids               = $this->getParams($item['celsius_ids']);
            $celsius_names             = $DoctorCelsiusModel->where('id', 'in', $celsius_ids)->column('name');
            $item['celsius_names']     = $this->setParams($celsius_names);
            $item['celsius_name_list'] = $celsius_names;
            $item['celsius_ids']       = $celsius_ids;
        }

        //部位
        if ($item['part_ids']) {
            $part_ids               = $this->getParams($item['part_ids']);
            $part_names             = $DoctorPartModel->where('id', 'in', $part_ids)->column('name');
            $item['part_names']     = $this->setParams($part_names);
            $item['part_name_list'] = $part_names;
            $item['part_ids']       = $part_ids;
        }

        //退烧药
        if ($item['drug_ids']) {
            $drug_ids               = $this->getParams($item['drug_ids']);
            $drug_names             = $DoctorDrugModel->where('id', 'in', $drug_ids)->column('name');
            $item['drug_names']     = $this->setParams($drug_names);
            $item['drug_name_list'] = $drug_names;
            $item['drug_ids']       = $drug_ids;
        }

        /** 处理文字描述 **/
        $item['is_drug_name'] = $this->is_drug[$item['is_drug']];


        /** 处理数据 **/
        if ($this->InterfaceType == 'api') {
            /** api处理文件 **/


            /** 处理富文本 **/
            if ($item['content']) $item['content'] = htmlspecialchars_decode(cmf_replace_content_file_url($item['content']));//说明


            if ($this->DataFormat == 'find') {
                /** find详情数据格式 **/


            } else {
                /** list列表数据格式 **/

            }


        } else {
            /** admin处理文件 **/


            if ($this->DataFormat == 'find') {
                /** find详情数据格式 **/


                /** 处理富文本 **/
                if ($item['content']) $item['content'] = htmlspecialchars_decode(cmf_replace_content_file_url($item['content']));//说明


            } else {
                /** list列表数据格式 **/

            }

        }


        /** 导出数据处理 **/
        if (isset($params["is_export"]) && $params["is_export"]) {
            $item["create_time"] = date("Y-m-d H:i:s", $item["create_time"]);
            $item["update_time"] = date("Y-m-d H:i:s", $item["update_time"]);
        }

        return $item;
    }


    /**
     * 获取列表
     * @param $where  条件
     * @param $params 扩充参数 order=排序  field=过滤字段 limit=限制条数  InterfaceType=admin|api后端,前端
     * @return false|mixed
     */
    public function get_list($where = [], $params = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)


        /** 查询数据 **/
        $result = $DoctorFructifyModel
            ->where($where)
            ->order($params['order'] ?? $this->Order)
            ->field($params['field'] ?? $this->Field)
            ->limit($params["limit"] ?? $this->Limit)
            ->select()
            ->each(function ($item, $key) use ($params) {

                /** 处理公共数据 **/
                $item = $this->common_item($item, $params);

                return $item;
            });

        /** 根据接口类型,返回不同数据类型 **/
        if ($params['InterfaceType']) $this->InterfaceType = $params['InterfaceType'];
        if ($this->InterfaceType == 'api' && empty(count($result))) return false;

        return $result;
    }


    /**
     * 分页查询
     * @param $where  条件
     * @param $params 扩充参数 order=排序  field=过滤字段 page_size=每页条数  InterfaceType=admin|api后端,前端
     * @return mixed
     */
    public function get_list_paginate($where = [], $params = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)


        /** 查询数据 **/
        $result = $DoctorFructifyModel
            ->where($where)
            ->order($params['order'] ?? $this->Order)
            ->field($params['field'] ?? $this->Field)
            ->paginate(["list_rows" => $params["page_size"] ?? $this->PageSize, "query" => $params])
            ->each(function ($item, $key) use ($params) {

                /** 处理公共数据 **/
                $item = $this->common_item($item, $params);

                return $item;
            });

        /** 根据接口类型,返回不同数据类型 **/
        if ($params['InterfaceType']) $this->InterfaceType = $params['InterfaceType'];
        if ($this->InterfaceType == 'api' && $result->isEmpty()) return false;


        return $result;
    }

    /**
     * 获取列表
     * @param $where  条件
     * @param $params 扩充参数 order=排序  field=过滤字段 limit=限制条数  InterfaceType=admin|api后端,前端
     * @return false|mixed
     */
    public function get_join_list($where = [], $params = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)

        /** 查询数据 **/
        $result = $DoctorFructifyModel
            ->alias('a')
            ->join('member b', 'a.user_id = b.id')
            ->where($where)
            ->order('a.id desc')
            ->field('a.*')
            ->paginate(["list_rows" => $params["page_size"] ?? $this->PageSize, "query" => $params])
            ->each(function ($item, $key) use ($params) {

                /** 处理公共数据 **/
                $item = $this->common_item($item, $params);


                return $item;
            });

        /** 根据接口类型,返回不同数据类型 **/
        if ($params['InterfaceType']) $this->InterfaceType = $params['InterfaceType'];
        if ($this->InterfaceType == 'api' && empty(count($result))) return false;

        return $result;
    }


    /**
     * 获取详情
     * @param $where     条件 或 id值
     * @param $params    扩充参数 field=过滤字段  InterfaceType=admin|api后端,前端
     * @return false|mixed
     */
    public function get_find($where = [], $params = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)

        /** 可直接传id,或者where条件 **/
        if (is_string($where) || is_int($where)) $where = ["id" => (int)$where];
        if (empty($where)) return false;

        /** 查询数据 **/
        $item = $DoctorFructifyModel
            ->where($where)
            ->order($params['order'] ?? $this->Order)
            ->field($params['field'] ?? $this->Field)
            ->find();


        if (empty($item)) return false;


        /** 处理公共数据 **/
        $item = $this->common_item($item, $params);


        return $item;
    }


    /**
     * 前端  编辑&添加
     * @param $params 参数
     * @param $where  where条件
     * @return void
     */
    public function api_edit_post($params = [], $where = [])
    {
        $result = false;

        /** 接口提交,处理数据 **/


        $result = $this->edit_post($params, $where);//api提交

        return $result;
    }


    /**
     * 后台  编辑&添加
     * @param $model  类
     * @param $params 参数
     * @param $where  更新提交(编辑数据使用)
     * @return void
     */
    public function admin_edit_post($params = [], $where = [])
    {
        $result = false;

        /** 后台提交,处理数据 **/


        $result = $this->edit_post($params, $where);//admin提交

        return $result;
    }


    /**
     * 提交 编辑&添加
     * @param $params
     * @param $where where条件(或传id)
     * @return void
     */
    public function edit_post($params, $where = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)


        /** 查询详情数据 && 需要再打开 **/
        //if (!empty($params["id"])) $item = $this->get_find(["id" => $params["id"]],["DataFormat"=>"list"]);
        //if (empty($params["id"]) && !empty($where)) $item = $this->get_find($where,["DataFormat"=>"list"]);

        /** 可直接传id,或者where条件 **/
        if (is_string($where) || is_int($where)) $where = ["id" => (int)$where];


        /** 公共提交,处理数据 **/
        //患者年龄
        if ($params['age_ids']) {
            $age_ids           = array_keys($params['age_ids']);//提取key
            $params['age_ids'] = $this->setParams($age_ids);
        } else {
            $params['age_ids'] = '';
        }

        //体重
        if ($params['weight_ids']) {
            $weight_ids           = array_keys($params['weight_ids']);//提取key
            $params['weight_ids'] = $this->setParams($weight_ids);
        } else {
            $params['weight_ids'] = '';
        }

        //既往史
        if ($params['past_ids']) {
            $past_ids           = array_keys($params['past_ids']);//提取key
            $params['past_ids'] = $this->setParams($past_ids);
        } else {
            $params['past_ids'] = '';
        }

        //过敏史
        if ($params['allergy_ids']) {
            $allergy_ids           = array_keys($params['allergy_ids']);//提取key
            $params['allergy_ids'] = $this->setParams($allergy_ids);
        } else {
            $params['allergy_ids'] = '';
        }

        //温度
        if ($params['celsius_ids']) {
            $celsius_ids           = array_keys($params['celsius_ids']);//提取key
            $params['celsius_ids'] = $this->setParams($celsius_ids);
        } else {
            $params['celsius_ids'] = '';
        }

        //部位
        if ($params['part_ids']) {
            $part_ids           = array_keys($params['part_ids']);//提取key
            $params['part_ids'] = $this->setParams($part_ids);
        } else {
            $params['part_ids'] = '';
        }

        //退烧药
        if ($params['drug_ids']) {
            $drug_ids           = array_keys($params['drug_ids']);//提取key
            $params['drug_ids'] = $this->setParams($drug_ids);
        } else {
            $params['drug_ids'] = '';
        }


        if (!empty($where)) {
            //传入where条件,根据条件更新数据
            $params["update_time"] = time();
            $result                = $DoctorFructifyModel->where($where)->strict(false)->update($params);
            //if ($result) $result = $item["id"];
        } elseif (!empty($params["id"])) {
            //如传入id,根据id编辑数据
            $params["update_time"] = time();
            $result                = $DoctorFructifyModel->where("id", "=", $params["id"])->strict(false)->update($params);
            //if($result) $result = $item["id"];
        } else {
            //无更新条件则添加数据
            $params["create_time"] = time();
            $result                = $DoctorFructifyModel->strict(false)->insert($params, true);
        }

        return $result;
    }


    /**
     * 提交(副本,无任何操作,不查询详情,不返回id) 编辑&添加
     * @param $params
     * @param $where where 条件(或传id)
     * @return void
     */
    public function edit_post_two($params, $where = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)


        /** 可直接传id,或者where条件 **/
        if (is_string($where) || is_int($where)) $where = ["id" => (int)$where];


        /** 公共提交,处理数据 **/


        if (!empty($where)) {
            //传入where条件,根据条件更新数据
            $params["update_time"] = time();
            $result                = $DoctorFructifyModel->where($where)->strict(false)->update($params);
        } elseif (!empty($params["id"])) {
            //如传入id,根据id编辑数据
            $params["update_time"] = time();
            $result                = $DoctorFructifyModel->where("id", "=", $params["id"])->strict(false)->update($params);
        } else {
            //无更新条件则添加数据
            $params["create_time"] = time();
            $result                = $DoctorFructifyModel->strict(false)->insert($params);
        }

        return $result;
    }


    /**
     * 删除数据 软删除
     * @param $id     传id  int或array都可以
     * @param $type   1软删除 2真实删除
     * @param $params 扩充参数
     * @return void
     */
    public function delete_post($id, $type = 1, $params = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)


        if ($type == 1) $result = $DoctorFructifyModel->destroy($id);//软删除 数据表字段必须有delete_time
        if ($type == 2) $result = $DoctorFructifyModel->destroy($id, true);//真实删除

        return $result;
    }


    /**
     * 后台批量操作
     * @param $id
     * @param $params 修改值
     * @return void
     */
    public function batch_post($id, $params = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)

        $where   = [];
        $where[] = ["id", "in", $id];//$id 为数组


        $params["update_time"] = time();
        $result                = $DoctorFructifyModel->where($where)->strict(false)->update($params);//修改状态

        return $result;
    }


    /**
     * 后台  排序
     * @param $list_order 排序
     * @param $params     扩充参数
     * @return void
     */
    public function list_order_post($list_order, $params = [])
    {
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理   (ps:InitModel)

        foreach ($list_order as $k => $v) {
            $where   = [];
            $where[] = ["id", "=", $k];
            $result  = $DoctorFructifyModel->where($where)->strict(false)->update(["list_order" => $v, "update_time" => time()]);//排序
        }

        return $result;
    }


    /**
     * 导出数据
     * @param array $where 条件
     */
    public function export_excel($where = [], $params = [])
    {
        $DoctorFructifyInit  = new \init\DoctorFructifyInit();//结果管理   (ps:InitController)
        $DoctorFructifyModel = new \initmodel\DoctorFructifyModel(); //结果管理  (ps:InitModel)

        $result = $DoctorFructifyInit->get_list($where, $params);

        $result = $result->toArray();
        foreach ($result as $k => &$item) {

            //订单号过长问题
            if ($item["order_num"]) $item["order_num"] = $item["order_num"] . "\t";

            //图片链接 可用默认浏览器打开   后面为展示链接名字 --单独,多图特殊处理一下
            if ($item["image"]) $item["image"] = '=HYPERLINK("' . cmf_get_asset_url($item['image']) . '","图片.png")';


            //用户信息
            $user_info        = $item['user_info'];
            $item['userInfo'] = "(ID:{$user_info['id']}) {$user_info['nickname']}  {$user_info['phone']}";


            //背景颜色
            if ($item['unit'] == '测试8') $item['BackgroundColor'] = 'red';
        }

        $headArrValue = [
            ["rowName" => "ID", "rowVal" => "id", "width" => 10],
            ["rowName" => "用户信息", "rowVal" => "userInfo", "width" => 30],
            ["rowName" => "名字", "rowVal" => "name", "width" => 20],
            ["rowName" => "年龄", "rowVal" => "age", "width" => 20],
            ["rowName" => "测试", "rowVal" => "test", "width" => 20],
            ["rowName" => "创建时间", "rowVal" => "create_time", "width" => 30],
        ];


        //副标题 纵单元格
        //        $subtitle = [
        //            ["rowName" => "列1", "acrossCells" => count($headArrValue)/2],
        //            ["rowName" => "列2", "acrossCells" => count($headArrValue)/2],
        //        ];

        $Excel = new ExcelController();
        $Excel->excelExports($result, $headArrValue, ["fileName" => "结果管理"]);
    }

}
