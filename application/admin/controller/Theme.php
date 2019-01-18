<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\ThemeModel;

class Theme extends common
{
    public function index()
    {

        $lists=ThemeModel::order('sort','desc')->where('is_delete',ThemeModel::$isDelete['no']['val'])->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function add()
    {        
        if($_POST){
            $data=request()->post();
            $theme=new ThemeModel();
            $theme->name=$data['name'];
            $theme->sort=$data['sort'];
            if($theme->save()){
                $this->redirect('Theme/index');
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
            $theme=ThemeModel::find($data['id']);
            $theme->name=$data['name'];
            $theme->sort=$data['sort'];
            if($theme->save()){
                $this->redirect('Theme/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=ThemeModel::where('id',$id)->find();
        $this->assign('list',$list); 
        return $this->fetch();
    }


    public function delete()
    {
        $id=$_GET['id'];
        $theme=ThemeModel::where('id',$id)->find();
        $theme->is_delete=ThemeModel::$isDelete['yes']['val'];
        if($theme->save()){
            $this->redirect('Theme/index');
        }else{
            $this->error('删除失败!');
        }
    }



}