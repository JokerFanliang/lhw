<?php
namespace app\model;
use think\Model;

class Price2Model extends Model
{
    protected $table = 'price2';
    
    public static $isDelete=[
    	'no'=>['txt'=>'未删除','val'=>0],
    	'yes'=>['txt'=>'删除','val'=>1]
    ];
}