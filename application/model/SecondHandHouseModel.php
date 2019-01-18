<?php
namespace app\model;
use think\Model;

class SecondHandHouseModel extends Model
{
    protected $table = 'second_hand_house';

    public static $types=[
    	'lease'=>['txt'=>'出租','val'=>0],
    	'sale'=>['txt'=>'买卖','val'=>1]
    ];
    

}