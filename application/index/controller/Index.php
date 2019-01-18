<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\model\AskingModel;
use app\model\AreaModel;
use app\model\ThemeModel;
use app\model\BuildingModel;
use app\model\AdModel;
use app\model\HouseShowModel;
use app\model\ConfigModel;
use app\model\VideoModel;

class Index extends Controller
{
    public function index()
    {
        Session::set('title', "shouye");

    	$asking_up=AskingModel::order('update_time','desc')->limit('0,6')->select();
    	$asking_down=AskingModel::order('update_time','desc')->limit('6,6')->select();
    	$area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->order('sort','desc')->select();

        $yushou=BuildingModel::where('is_delete',BuildingModel::$isDelete['no']['val'])->where('state',BuildingModel::$state['yushou']['val'])->order('update_time','desc')->limit('0,6')->select();
        $xianfang=BuildingModel::where('is_delete',BuildingModel::$isDelete['no']['val'])->where('state',BuildingModel::$state['xianfang']['val'])->order('update_time','desc')->limit('0,6')->select();
        $shipin=BuildingModel::where('is_delete',BuildingModel::$isDelete['no']['val'])->where('state',BuildingModel::$state['video']['val'])->order('update_time','desc')->limit('0,6')->select();
        if(isset($_GET['theme_id'])){
        	$yushou=BuildingModel::where('is_delete',BuildingModel::$isDelete['no']['val'])->where('theme_id',$_GET['theme_id'])->where('state',BuildingModel::$state['yushou']['val'])->order('update_time','desc')->limit('0,6')->select();
        }
        $lists=BuildingModel::where('is_delete',BuildingModel::$isDelete['no']['val'])->order('update_time','desc')->select();
        $imgs=[];
        $video=[];
        foreach($lists as $list){
            $bul=HouseShowModel::order('update_time','desc')->where('building_id',$list->id)->find();
            $vid=VideoModel::order('update_time','desc')->where('building_id',$list->id)->find();

            if($bul){
                $imgs[$list->id]=$bul->photo;
            }else{
                $imgs[$list->id]="";
            }
            if($vid){
                $video[$list->id]=$vid->path;
            }else{
                $video[$list->id]="";
            }
            
            
        }
        $theme_id=isset($_GET['theme_id']) ? $_GET['theme_id'] : '0';
        //广告
        
        $one_up=AdModel::where('position','one_up')->find();
        $two_up=AdModel::where('position','two_up')->find();
        $two_left=AdModel::where('position','two_left')->find();
        $two_right_up=AdModel::where('position','two_right_up')->find();
        $two_right_down=AdModel::where('position','two_right_down')->find();
        $three_right_up=AdModel::where('position','three_right_up')->find();
        $three_right_down=AdModel::where('position','three_right_down')->find();
        $three_up=AdModel::where('position','three_up')->find();
        $three_left=AdModel::where('position','three_left')->find();
        $config=ConfigModel::where('id',1)->find();
        $this->assign('config',$config);
        $this->assign('video',$video);
        $this->assign('one_up',$one_up);
        $this->assign('two_up',$two_up);
        $this->assign('two_left',$two_left);
        $this->assign('two_right_up',$two_right_up);
        $this->assign('two_right_down',$two_right_down);
        $this->assign('three_right_up',$three_right_up);
        $this->assign('three_right_down',$three_right_down);
        $this->assign('three_up',$three_up);
        $this->assign('three_left',$three_left);
        $this->assign('theme_id',$theme_id);
        $this->assign('area',$area);
        $this->assign('theme',$theme);
    	$this->assign('asking_up',$asking_up);
    	$this->assign('asking_down',$asking_down);
    	$this->assign('yushou',$yushou);
        $this->assign('xianfang',$xianfang);
        $this->assign('shipin',$shipin);
        $this->assign('imgs',$imgs);
        return $this->fetch();
    }

}
