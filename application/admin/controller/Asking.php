<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\AskingModel;

class Asking extends common
{
    public function index()
    {

        $lists=AskingModel::order('create_time','desc')->paginate(10);
        return view('index',compact('lists'));
    }

    public function add()
    {        
        if($_POST){
            $img=request()->file('img');
            $data=request()->post();
            $asking=new AskingModel();
            $asking->question=$data['question'];
            $asking->type=$data['type'];
			$asking->summary=$data['summary'];
            $asking->answer=$data['answer'];
            $asking->title=$data['title'];
            if($img){
                $info=$img->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $filePath= str_replace('\\', '/', $filePathss);
                }

                $asking->img=$filePath;
            }
            if($asking->save()){
                $this->redirect('Asking/index');
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
            $img=request()->file('img');
            $asking=AskingModel::find($data['id']);
            $asking->question=$data['question'];
            $asking->type=$data['type'];
			$asking->summary=$data['summary'];
            $asking->answer=$data['answer'];
            $asking->title=$data['title'];
            if($img){
                $info=$img->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $filePath= str_replace('\\', '/', $filePathss);
                }

                $asking->img=$filePath;
            }
            if($asking->save()){
                $this->success('修改成功','Asking/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=AskingModel::where('id',$id)->find();
        return view('edit',compact('list'));
    }


    public function delete()
    {
        $id=$_GET['id'];
        $asking=AskingModel::where('id',$id)->find();
        if($asking->delete()){
            $this->success('删除成功','Asking/index');
        }else{
            $this->error('删除失败!');
        }
    }



}