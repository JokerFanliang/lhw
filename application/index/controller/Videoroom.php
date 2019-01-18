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
use app\model\VideoModel;

class Videoroom extends Controller
{
    public function shipinkanfang()
    {
        Session::set('title','video');
        $video_ids=VideoModel::group('building_id')->column('building_id');
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
        $video=[];
        foreach($video_ids as $id){
            $video[$id]=VideoModel::where('building_id',$id)->order('update_time','desc')->find();
        }

        if(isset($data['searchname'])){
            $searchname=$data["searchname"];
            $build = BuildingModel::where('name','like','%'.$searchname.'%')->order('update_time','desc')->where('state',BuildingModel::$state['video']['val'])->where('is_delete',BuildingModel::$isDelete['no']['val'])->paginate(9,false,['query'=>['searchname'=>$searchname]]);
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

            })->order('update_time','desc')->where('state',BuildingModel::$state['video']['val'])->paginate(9,false,['query'=>['area'=>$data['area'],'price'=>$data['price'],'layout'=>$data['layout'],'theme'=>$data['theme']]]);
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

        $hotbuild=BuildingModel::where('is_delete',BuildingModel::$isDelete['no']['val'])->where('state',BuildingModel::$state['video']['val'])->order('is_hot','desc')->order('read_count','desc')->limit(0,8)->select();
        $area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $price=PriceModel::where('is_delete',PriceModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $layout=LayoutModel::where('is_delete',LayoutModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $state=StateModel::where('is_delete',StateModel::$isDelete['no']['val'])->order('sort','desc')->select();

        $video_up=AdModel::where('position','video_up')->find();
        $video_down=AdModel::where('position','video_down')->find();

        $this->assign('video',$video);
        $this->assign('video_up',$video_up);
        $this->assign('video_down',$video_down);
        $this->assign('area',$area);
        $this->assign('price',$price);
        $this->assign('layout',$layout);
        $this->assign('state',$state);
        $this->assign('theme',$theme);
        $this->assign('data',$data);
        $this->assign('build',$build);
        $this->assign('hotbuild',$hotbuild);
        $this->assign('imgs',$imgs);
        return $this->fetch();
    }
    public function shipinkanfang_detaile()
    {
        $id=$_GET['id'];
    	  $build=BuildingModel::find($id);
        $state_ids=BuildStateModel::where('build_id',$build->id)->column('state_id');
        $state_name=StateModel::wherein('id',$state_ids)->column('name');
        $state_name=implode(",",$state_name);
        $theme_ids=BuildThemeModel::where('build_id',$build->id)->column('theme_id');
        $theme_name=ThemeModel::wherein('id',$theme_ids)->column('name');
        $theme_name=implode(",",$theme_name);
        $bul=HouseShowModel::where('building_id',$build->id)->find();
        $build->read_count=$build->read_count+1;
        $build->save();
    	  $dynamic=BuildingDynamicModel::where('building_id',$id)->select();
        $video=VideoModel::where('building_id',$id)->order('sort','desc')->select();
        $show=VideoModel::where('building_id',$id)->order('sort','desc')->find();
        if(isset($_GET['videoid'])){
            $show=VideoModel::find($_GET['videoid']);
        }
        $housetype=HouseTypeModel::where('building_id',$id)->select();
        $this->assign('housetype',$housetype);
        $this->assign('show',$show);
        $this->assign('video',$video);
        $this->assign('bul',$bul);
    	  $this->assign('build',$build);
    	  $this->assign('dynamic',$dynamic);
        $this->assign('state_name',$state_name);
        $this->assign('theme_name',$theme_name);
        return $this->fetch();
    }
}
