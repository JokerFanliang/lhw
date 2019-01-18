<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\model\BuildingDynamicModel;


class BuildingDynamic extends Controller
{
    public function index()
    {
        $building_id=$_GET['building_id'];
        $lists=BuildingDynamicModel::where('building_id',$building_id)->order('update_time','desc')->paginate(10,false,['query'=>['building_id'=>$building_id],]);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function detail()
    {
        $id=$_GET['id'];
        $building_id=$_GET['building_id'];
        $list=BuildingDynamicModel::find($id);
        $prev=BuildingDynamicModel::where('id','<',$id)->order('id','desc')->where('building_id',$building_id)->find();
        $next=BuildingDynamicModel::where('id','>',$id)->where('building_id',$building_id)->find();
        $this->assign('prev',$prev);
        $this->assign('next',$next);
        $this->assign('list',$list);
        return $this->fetch();
    }

}
