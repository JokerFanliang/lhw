<?php
namespace app\model;
use think\Model;

class BuildingModel extends Model
{
    protected $table = 'building';
    public static $isDelete=[
    	'no'=>['txt'=>'未删除','val'=>0],
    	'yes'=>['txt'=>'删除','val'=>1]
    ];

    public static $state=[
    	'yushou'=>['txt'=>'预售','val'=>0],
    	'xianfang'=>['txt'=>'现房','val'=>1],
		'video'=>['txt'=>'视频看房','val'=>2]
    ];

}