<?php
namespace app\model;
use think\Model;

class StateModel extends Model
{
    protected $table = 'state';

    public static $isDelete=[
    	'no'=>['txt'=>'未删除','val'=>0],
    	'yes'=>['txt'=>'删除','val'=>1]
    ];
    

}