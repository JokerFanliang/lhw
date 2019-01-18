<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use app\model\AreaModel;
use app\model\PriceModel;
use app\model\LayoutModel;
use app\model\ThemeModel;
use app\model\BuildingModel;
use app\model\StateModel;
use app\model\BuildLayoutModel;
use app\model\BuildThemeModel;
use app\model\BuildPriceModel;
use app\model\BuildStateModel;
use app\model\BuildingDynamicModel;
use app\model\AdModel;
use app\model\HouseTypeModel;
use app\model\HouseShowModel;

class Advancesale extends Controller
{
    public function louhuayushou()
    {
        // $buildings=BuildingModel::select();
        // foreach($buildings as $build){
        //     $lays=new BuildPriceModel();
        //     $lays->build_id=$build->id;
        //     $lays->price_id=$build->price_id;
        //     $lays->save();
        // }
        // exit;
        Session::set('title', "yushou");
    	$data=request()->get();
        $data['area']=isset($data['area']) ? $data['area'] : '0'; 
        $data['price']=isset($data['price']) ? $data['price'] : '0'; 
        $data['layout']=isset($data['layout']) ? $data['layout'] : '0'; 
        $data['theme']=isset($data['theme']) ? $data['theme'] : '0';
        $data['state']=isset($data['state']) ? $data['state'] : '0';

        
        // if(!Session::has('layouts')){
        //     $layouts=[];
        //     Session::set('layouts',$layouts);
        // }
        // if($data['layout']!=0){
        //     $layouts=Session::get('layouts');
        //     if(in_array($data['layout'], $layouts)){
        //         $layouts = array_diff($layouts, [$data['layout']]);
        //     }else{
        //         array_push($layouts,$data['layout']);
        //     }
            
        // }else{
        //     $layouts=[];            
        // } 

        // Session::set('layouts',$layouts);
        
        if(isset($data['searchname'])){
            $searchname=$data["searchname"];
            $build = BuildingModel::where('name','like','%'.$searchname.'%')->order('update_time','desc')->where('is_delete',BuildingModel::$isDelete['no']['val'])->where('state',BuildingModel::$state['yushou']['val'])->paginate(9,false,['query'=>['searchname'=>$searchname]]);
        }else{
            $build = BuildingModel::where(function($query)use($data){
                if(isset($data['area']) && $data['area']!='0'){
                    $query->where('area_id',$data['area']);
                }
                if(isset($data['price']) && $data['price']!='0'){
                    $build_ids=BuildPriceModel::wherein('price_id',$data['price'])->column('build_id');
                    $build_ids=array_unique($build_ids);
                    $query->wherein('id',$build_ids);
                }
                if(isset($data['layout']) && $data['layout']!='0'){
                    $build_ids=BuildLayoutModel::wherein('layout_id',$data['layout'])->column('build_id');
                    $build_ids=array_unique($build_ids);
                    $query->wherein('id',$build_ids);
                }
                if(isset($data['theme']) && $data['theme']!='0'){
                    $build_ids=BuildThemeModel::wherein('theme_id',$data['theme'])->column('build_id');
                    $build_ids=array_unique($build_ids);
                    $query->wherein('id',$build_ids);
                }
                if(isset($data['state']) && $data['state']!='0'){
                    $build_ids=BuildStateModel::wherein('state_id',$data['state'])->column('build_id');
                    $build_ids=array_unique($build_ids);
                    $query->wherein('id',$build_ids);
                }
                               
                $query->where('is_delete',BuildingModel::$isDelete['no']['val']);
    
            })->order('update_time','desc')->where('state',BuildingModel::$state['yushou']['val'])->paginate(9,false,['query'=>['area'=>$data['area'],'price'=>$data['price'],'layout'=>$data['layout'],'theme'=>$data['theme']]]);
        }

        $imgs=[];
        foreach($build as $list){
            $bul=HouseShowModel::where('building_id',$list->id)->find();
            if($bul){
                $imgs[$list->id]=$bul->photo;
            }else{
                $imgs[$list->id]="";
            }
            
        }
        $hotbuild=BuildingModel::where('is_delete',BuildingModel::$isDelete['no']['val'])->where('state',BuildingModel::$state['yushou']['val'])->order('is_hot','desc')->order('read_count','desc')->limit(0,8)->select();
        $area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $price=PriceModel::where('is_delete',PriceModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $layout=LayoutModel::where('is_delete',LayoutModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $state=StateModel::where('is_delete',StateModel::$isDelete['no']['val'])->order('sort','desc')->select();

        $yushou_up=AdModel::where('position','yushou_up')->find();
        $yushou_down=AdModel::where('position','yushou_down')->find();

        $this->assign('yushou_up',$yushou_up);
        $this->assign('yushou_down',$yushou_down);
        $this->assign('area',$area);
        $this->assign('price',$price);
        $this->assign('layout',$layout);
        $this->assign('theme',$theme);
        $this->assign('data',$data);
        $this->assign('build',$build);
        $this->assign('state',$state);
        $this->assign('hotbuild',$hotbuild);
        $this->assign('imgs',$imgs);
        return $this->fetch();
    }
    public function louhuayushou_detaile()
    {	
    	$id=$_GET['id'];
    	$build=BuildingModel::find($id);
        $state_ids=BuildStateModel::where('build_id',$build->id)->column('state_id');
        $state_name=StateModel::wherein('id',$state_ids)->column('name');
        $state_name=implode(",",$state_name);
        $build->read_count= $build->read_count+1;
        $build->save();
    	$dynamic=BuildingDynamicModel::where('building_id',$id)->select();

        $houseshow=HouseShowModel::where('building_id',$id)->order('sort','desc')->select();
		$housetype=HouseTypeModel::where('building_id',$id)->order('sort','desc')->select();
        $show=HouseShowModel::where('building_id',$id)->find();
        if(isset($_GET['houseshowid'])){
            $show=HouseShowModel::find($_GET['houseshowid']);
        }
        $this->assign('show',$show);
        $this->assign('houseshow',$houseshow);
		$this->assign('housetype',$housetype);
    	$this->assign('build',$build);
    	$this->assign('dynamic',$dynamic);
        $this->assign('state_name',$state_name);
        return $this->fetch();
    }



}