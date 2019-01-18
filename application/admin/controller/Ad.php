<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\AdModel;

class Ad extends common
{
    public function index()
    {

        $lists=AdModel::order('create_time','desc')->paginate(10);
        return view('index',compact('lists'));
    }

    public function add(){
        if($_POST){
            $data=request()->post();
            $ad=new AdModel();
            $file = request()->file('ad')->getInfo();
            $name=explode(".",$file['name']);
            $count=count($name);
            $ext=$name[$count-1];
            $name=PUBLIC_PATH."/ad/".time().".".$ext;
            move_uploaded_file($file["tmp_name"],$name);
            $ad->path="/ad/".time().".".$ext;
            $ad->position="head";
            $ad->alias="网站头部";
            $ad->url="http://".$data['url'];
            if($ad->save()){
                $this->success('添加成功','Ad/index');
            }else{
               $this->error('修改失败!'); 
            }

        }
        return view('add');
    }

    public function edit(){
        if($_POST){
            $data=request()->post();
            $id=$data['id'];
            $ad=AdModel::find($id);
            if(request()->file('ad')){
                $file = request()->file('ad')->getInfo();
                $name=explode(".",$file['name']);
                $count=count($name);
                $ext=$name[$count-1];
                $name=PUBLIC_PATH."/ad/".time().".".$ext;
                move_uploaded_file($file["tmp_name"],$name);
                $ad->path="/ad/".time().".".$ext;
            }

            $ad->alias=$data['alias'];
            
            $ad->url="http://".$data['url'];
            if($ad->save()){
                $this->success('修改成功','Ad/index');
            }else{
                $this->error('修改失败!');
            }


        }
        $id=$_GET['id'];
        $list=AdModel::find($id);
        return view('edit',compact('list'));
    }

    public function delete(){
        $id=$_GET['id'];
        $ad=AdModel::find($id);
        if($ad->delete()){
            $this->success('删除成功','Ad/index');
        }else{
            $this->error('删除失败!');
        }
    }




}