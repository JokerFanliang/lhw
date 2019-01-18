<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\AdviceModel;

class Advice extends common
{
    public function index()
    {

        $lists=AdviceModel::order('create_time','desc')->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function see(){
        $id=$_GET['id'];
        $list=AdviceModel::find($id);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function delete(){
        $id=$_GET['id'];
        $advice=AdviceModel::find($id);
        if($advice->delete()){
            $this->redirect('Advice/index');
        }else{
            $this->error('删除失败!');
        }
    }




}