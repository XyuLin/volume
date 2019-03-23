<?php

namespace app\api\controller;

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
        $str = $this->request->post('str/s');
        $array = json_encode($str,true);
        $this->success('提交成功!');
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
