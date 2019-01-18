<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\model\AskingModel;


class Asking extends Controller
{
    public function index()
    {
        $lists=AskingModel::order('update_time','desc')->paginate(5);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function detail()
    {
        $id=$_GET['id'];
        $list=AskingModel::find($id);
        $prev=AskingModel::where('id','<',$id)->order('id','desc')->find();
        $next=AskingModel::where('id','>',$id)->find();
        $this->assign('prev',$prev);
        $this->assign('next',$next);
        $this->assign('list',$list);
        return $this->fetch();
    }

}
