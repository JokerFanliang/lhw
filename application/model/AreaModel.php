<?php
namespace app\model;
use think\Model;

class AreaModel extends Model
{
    protected $table = 'area';

    public static $isDelete=[
    	'no'=>['txt'=>'未删除','val'=>0],
    	'yes'=>['txt'=>'删除','val'=>1]
    ];
    

}