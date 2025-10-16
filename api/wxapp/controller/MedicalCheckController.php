<?php

namespace api\wxapp\controller;


use think\facade\Db;
use think\facade\Log;
use think\facade\Cache;


error_reporting(0);

class MedicalCheckController extends AuthController
{


    /**
     * 辅助检查
     * @OA\Post(
     *     tags={"辅助检查"},
     *     path="/wxapp/medical_check/find_medical_check",
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
     *    @OA\Parameter(
     *         name="white_blood_cell",
     *         in="query",
     *         description="白血包",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *    @OA\Parameter(
     *         name="neutrophil_percentage",
     *         in="query",
     *         description="中性粒细胞百分比",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *
     *    @OA\Parameter(
     *         name="crp",
     *         in="query",
     *         description="C反应蛋白",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *    @OA\Parameter(
     *         name="hs_crp",
     *         in="query",
     *         description="超敏C反应蛋白",
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
     *         name="saa",
     *         in="query",
     *         description="血清淀粉样蛋白",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *
     *    @OA\Parameter(
     *         name="pct",
     *         in="query",
     *         description="降钙素原",
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
     *   test_environment: http://doctor2.ikun:9090/api/wxapp/medical_check/find_medical_check
     *   official_environment: https://xcxkf203.aubye.com/api/wxapp/medical_check/find_medical_check
     *   api:  /wxapp/medical_check/find_medical_check
     *   remark_name: 辅助检查
     *
     */
    public function find_medical_check()
    {
        $params = $this->request->param();
        return $this->success('结果',$this->processChecks($params));
    }


    /**
     * 处理所有检查项目并返回结果
     * @param array $params 前端提交的检查参数
     * @return array 处理后的结果
     */
    public function processChecks(array $params)
    {
        // 提取年龄参数，用于特定项目的判断
        $age = isset($params['age']) ? (int)$params['age'] : 0;

        // 定义所有检查项目的处理结果
        $results = [];

        // 处理白细胞检查
        if (isset($params['white_blood_cell'])) {
            $results['white_blood_cell'] = [
                'name'   => '白细胞',
                'value'  => $params['white_blood_cell'],
                'unit'   => '×109/L',
                'result' => $this->judgeWhiteBloodCell($params['white_blood_cell'])
            ];
        }

        // 处理中性粒细胞百分比
        if (isset($params['neutrophil_percentage'])) {
            $results['neutrophil_percentage'] = [
                'name'   => '中性粒细胞百分比',
                'value'  => $params['neutrophil_percentage'],
                'unit'   => '%',
                'result' => $this->judgeNeutrophilPercentage($params['neutrophil_percentage'], $age)
            ];
        }

        // 处理中性粒细胞数目
//        if (isset($params['neutrophil_count'])) {
//            $results['neutrophil_count'] = [
//                'name'   => '中性粒细胞数目',
//                'value'  => $params['neutrophil_count'],
//                'unit'   => '×109/L',
//                'result' => $this->judgeNeutrophilCount($params['neutrophil_count'])
//            ];
//        }

        // 处理C反应蛋白
        if (isset($params['crp'])) {
            $results['crp'] = [
                'name'   => 'C反应蛋白（CRP）',
                'value'  => $params['crp'],
                'unit'   => 'mg/L',
                'result' => $this->judgeCRP($params['crp'])
            ];
        }

        // 处理超敏C反应蛋白
        if (isset($params['hs_crp'])) {
            $results['hs_crp'] = [
                'name'   => '超敏C反应蛋白（hs-CRP）',
                'value'  => $params['hs_crp'],
                'unit'   => 'mg/L',
                'result' => $this->judgeHsCRP($params['hs_crp'])
            ];
        }

        // 处理血清淀粉样蛋白
        if (isset($params['saa'])) {
            $results['saa'] = [
                'name'   => '血清淀粉样蛋白（SAA）',
                'value'  => $params['saa'],
                'unit'   => 'mg/L',
                'result' => $this->judgeSAA($params['saa'])
            ];
        }

        // 处理降钙素原
        if (isset($params['pct'])) {
            $results['pct'] = [
                'name'   => '降钙素原（PCT）',
                'value'  => $params['pct'],
                'unit'   => 'μg/L或ng/mL',
                'result' => $this->judgePCT($params['pct'])
            ];
        }

        // 综合判断是否为病毒感染
//        $results['virus_infection_analysis'] = [
//            'name'   => '病毒感染综合判断',
//            'result' => $this->judgeVirusInfection($params)
//        ];

        return $results;
    }

    /**
     * 判断白细胞结果
     * @param float $value 检测值
     * @return string 判断结果
     */
    private function judgeWhiteBloodCell($value)
    {
        $value = (float)$value;

        if ($value <= 2) {
            return '危急值，建议就医诊治';
        } elseif ($value < 5) {
            return '提示病毒感染、革兰阴性杆菌感染等可能';
        } elseif ($value <= 12) {
            return '正常范围、病毒感染、革兰阴性杆菌感染可能';
        } elseif ($value < 30) {
            return '提示病毒感染、细菌感染等可能';
        } else {
            return '危急值，建议就医诊治';
        }
    }

    /**
     * 判断中性粒细胞百分比
     * @param float $value 检测值
     * @param int   $age   年龄(天)
     * @return string 判断结果
     */
    private function judgeNeutrophilPercentage($value, $age)
    {
        $value      = (float)$value;
        $ageInYears = $age / 365;

        // 6天-6岁：>50% 为阳性
        if ($age >= 6 && $ageInYears <= 6) {
            return $value > 50 ? '细菌感染可能' : '正常范围';
        } // 出生6天内、>6岁：>70% 为阳性
        else {
            return $value > 70 ? '细菌感染可能' : '正常范围';
        }
    }

    /**
     * 判断中性粒细胞数目
     * @param float $value 检测值
     * @return string 判断结果
     */
    private function judgeNeutrophilCount($value)
    {
        $value = (float)$value;

        if ($value < 0.5) {
            return '提示粒细胞缺乏症，感染风险增加';
        } else {
            return '正常范围';
        }
    }

    /**
     * 判断C反应蛋白
     * @param float $value 检测值
     * @return string 判断结果
     */
    private function judgeCRP($value)
    {
        $value = (float)$value;

        if ($value < 10) {
            return '排除细菌感染';
        } elseif ($value <= 25) {
            return '提示病毒感染可能，不建议使用抗菌药物';
        } elseif ($value <= 50) {
            return '提示细菌感染可能，酌情使用抗菌药物';
        } else {
            return '提示细菌感染可能性大，建议使用抗菌药物';
        }
    }

    /**
     * 判断超敏C反应蛋白
     * @param float $value 检测值
     * @return string 判断结果
     */
    private function judgeHsCRP($value)
    {
        $value = (float)$value;

        if ($value < 3) {
            return '正常范围';
        } elseif ($value <= 10) {
            return '提示低度炎症';
        } else {
            return '提示明显感染或炎症反应，短时间内成倍增高，预示心肌损害、炎症加剧';
        }
    }

    /**
     * 判断血清淀粉样蛋白
     * @param float $value 检测值
     * @return string 判断结果
     */
    private function judgeSAA($value)
    {
        $value = (float)$value;

        if ($value < 10) {
            return '排除感染';
        } elseif ($value < 100) {
            return '提示病毒感染可能';
        } elseif ($value < 500) {
            return '提示细菌感染可能';
        } else {
            return '提示病情严重，属于危急值';
        }
    }

    /**
     * 判断降钙素原
     * @param float $value 检测值
     * @return string 判断结果
     */
    private function judgePCT($value)
    {
        $value = (float)$value;

        if ($value < 0.05) {
            return '正常范围';
        } elseif ($value < 0.25) {
            return '提示局部感染、感染早期、其他情况，不支持细菌感染，不建议使用抗菌药物';
        } elseif ($value < 0.5) {
            return '提示细菌感染可能，推荐使用抗菌药物';
        } elseif ($value < 2.0) {
            return '提示侵袭性感染、其他情况，强烈推荐使用抗菌药物';
        } else {
            return '提示严重细菌感染、脓毒症可能，属于危急值，强烈推荐使用抗菌药物';
        }
    }

    /**
     * 判断是否为病毒感染
     * @param array $params 所有检测参数
     * @return string 判断结果
     */
    private function judgeVirusInfection($params)
    {
        $isVirusPossible = false;
        $reasons         = [];

        // SAA升高，CRP未升高，提示病毒感染可能
        if (isset($params['saa'], $params['crp'])) {
            $saa = (float)$params['saa'];
            $crp = (float)$params['crp'];

            if ($saa >= 10 && $crp < 10) {
                $isVirusPossible = true;
                $reasons[]       = "SAA升高而CRP未升高";
            }
        }

        // 白细胞在2-5范围提示病毒感染可能
        if (isset($params['white_blood_cell'])) {
            $wbc = (float)$params['white_blood_cell'];
            if ($wbc >= 2 && $wbc < 5) {
                $isVirusPossible = true;
                $reasons[]       = "白细胞值在2-5×109/L范围";
            }
        }

        // CRP在10-25范围提示病毒感染可能
        if (isset($params['crp'])) {
            $crp = (float)$params['crp'];
            if ($crp >= 10 && $crp <= 25) {
                $isVirusPossible = true;
                $reasons[]       = "CRP值在10-25mg/L范围";
            }
        }

        // SAA在10-100范围提示病毒感染可能
        if (isset($params['saa'])) {
            $saa = (float)$params['saa'];
            if ($saa >= 10 && $saa < 100) {
                $isVirusPossible = true;
                $reasons[]       = "SAA值在10-100mg/L范围";
            }
        }

        if ($isVirusPossible) {
            $reasonStr = implode("，", $reasons);
            return "病毒感染可能（{$reasonStr}）。病毒感染特点：症状往往多种；炎症指标不高；具有自限性；没有特效药，主要是对症处理。";
        } else {
            return "目前指标不支持病毒感染，更倾向于其他类型感染或正常情况";
        }
    }


}