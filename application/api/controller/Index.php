<?php

namespace app\api\controller;

use app\admin\model\Problem;
use app\common\controller\Api;
use app\common\model\Paper;

/**
 * 首页接口
 */
class Index extends Api
{

    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     * 
     */
    public function index()
    {
        $this->success('请求成功');
    }

    public function record()
    {
        $array = $this->request->param('data/a');
        $openid = $this->request->param('openid');
        $data = [];
        foreach($array as $key => $value) {
            if (count($value)==count($value, 1)) {
                // 一维数组
                $value['key'] = $key;
                $data[] =  $value;
            } else {
                // 多维数组
                array_walk($value,function(&$v,$k,$p) {
                    $v = array_merge($v,$p);
                },['key'=>$key]);

                $data = array_merge($data,$value);
            }
        }

        $model = new Paper();
        // 将openid 赋值
        array_walk($data,function(&$v,$k,$p) {
            $v = array_merge($v,$p);
        },['openid'=>$openid]);
        // 统计选择人数
        $count = [];
        $countKey = 0;
        foreach ($data as $key => $value) {
            if(isset($value['choose'])) {
                $count[$countKey]['id'] = $value['key'] + 1;
                $count[$countKey][$value['choose']] = ['inc','1'];
                $countKey++;
            }
        }
        $problem = new Problem();
        $problem->saveAll($count);
        $result = $model->allowField(true)->saveAll($data);
        $this->success('提交成功!',$result);
    }


    public function census()
    {
//        $model = new Paper();
//        // 想所有数据统计出
//        $list = $model->column('paper');
//
//        // 便利数据统计
//        $data = [];
//        foreach($list as $key => $value) {
//            // 将json字符串转为数据
//            $array = json_encode($value,true);
//            foreach($array $k => $v) {
//                $data[$k]
//            }
//        }
    }
}
