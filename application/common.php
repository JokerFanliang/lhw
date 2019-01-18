<?php
use app\model\AdModel;
use app\model\ConfigModel;
use think\Session;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function getHeadPath(){
	$ad=AdModel::where('position','head')->select();
	return $ad;
}

function getBuildUpPath(){
	$ad=AdModel::where('position','building_up')->find();
	return $ad;
}

function getBuildDownPath(){
	$ad=AdModel::where('position','building_down')->find();
	return $ad;
}

function getTitleSession(){
	return Session::get('title');
}

function getAdminType(){
	return Session::get('admin_type');
}

function getConfig(){
	$config=ConfigModel::where('id',1)->find();
	return $config;
}