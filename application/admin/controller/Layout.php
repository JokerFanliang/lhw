<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\LayoutModel;

class Layout extends common
{
    public function index()
    {

        $lists=LayoutModel::order('sort','desc')->where('is_delete',LayoutModel::$isDelete['no']['val'])->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function add()
    {        
        if($_POST){
            $data=request()->post();
            $layout=new LayoutModel();
            $layout->name=$data['name'];
            $layout->sort=$data['sort'];
            if($layout->save()){
                $this->redirect('Layout/index');
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
            $layout=LayoutModel::find($data['id']);
            $layout->name=$data['name'];
            $layout->sort=$data['sort'];
            if($layout->save()){
                $this->redirect('Layout/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=LayoutModel::where('id',$id)->find();
        $this->assign('list',$list); 
        return $this->fetch();
    }


    public function delete()
    {
        $id=$_GET['id'];
        $layout=LayoutModel::where('id',$id)->find();
        $layout->is_delete=LayoutModel::$isDelete['yes']['val'];
        if($layout->save()){
            $this->redirect('Layout/index');
        }else{
            $this->error('删除失败!');
        }
    }



}