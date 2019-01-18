<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\StateModel;

class State extends common
{
    public function index()
    {

        $lists=StateModel::order('sort','desc')->where('is_delete',StateModel::$isDelete['no']['val'])->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function add()
    {        
        if($_POST){
            $data=request()->post();
            $area=new StateModel();
            $area->name=$data['name'];
            $area->sort=$data['sort'];
            if($area->save()){
                $this->redirect('State/index');
            }else{
                $this->error('添加失败!');
            }
        }
        return $this->fetch();
    }

    public function edit()
    {
        if($_POST){
            $data=request()->post();
            $area=StateModel::find($data['id']);
            $area->name=$data['name'];
            $area->sort=$data['sort'];
            if($area->save()){
                $this->redirect('State/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=StateModel::where('id',$id)->find();
        $this->assign('list',$list); 
        return $this->fetch();
    }


    public function delete()
    {
        $id=$_GET['id'];
        $area=StateModel::where('id',$id)->find();
        $area->is_delete=StateModel::$isDelete['yes']['val'];
        if($area->save()){
            $this->redirect('State/index');
        }else{
            $this->error('删除失败!');
        }
    }




}