<?php
/**
 * Created by PhpStorm.
 * User: L丶lin
 * Date: 2019/3/22
 * Time: 18:00
 */

namespace app\common\model;


use think\Model;

class Paper extends Model
{

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    // 追加属性
    protected $append = [
    ];
}