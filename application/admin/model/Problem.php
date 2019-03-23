<?php

namespace app\admin\model;

use app\common\model\Paper;
use think\Model;


class Problem extends Model
{

    

    // 表名
    protected $name = 'problem';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'a_name',
        'b_name',
        'c_name',
        'd_name',
        'e_name',
        'h_name',
        'g_name',
        'i_name',
    ];
    

    protected static function init()
    {
        self::afterInsert(function ($row) {
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
    }

    public function getANameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','A')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['A'];
        }
    }

    public function getBNameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','B')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['B'];
        }
    }

    public function getCNameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','C')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['C'];
        }
    }

    public function getDNameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','D')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['D'];
        }
    }

    public function getENameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','E')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['E'];
        }
    }

    public function getHNameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','H')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['H'];
        }
    }


    public function getGNameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','G')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['G'];
        }
    }

    public function getINameAttr($value,$data)
    {
        $content = Paper::where('key',$data['id']-1)->where('choose','eq','I')->value('content');
        if(empty($content)) {
            return '';
        } else {
            return $content .'——投票人数 '.$data['I'];
        }
    }

    







}
