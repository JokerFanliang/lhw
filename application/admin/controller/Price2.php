<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\Price2Model;

class Price2 extends common
{
    public function index()
    {

        $lists=Price2Model::order('sort','desc')->where('is_delete',Price2Model::$isDelete['no']['val'])->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function add()
    {        
        if($_POST){
            $data=request()->post();
            $price=new Price2Model();
            $price->min=$data['min'];
			$price->max=$data['max'];
            $price->sort=$data['sort'];
            if($price->save()){
                $this->redirect('Price2/index');
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
            $price=Price2Model::find($data['id']);
            $price->min=$data['min'];
			$price->max=$data['max'];
            $price->sort=$data['sort'];
            if($price->save()){
                $this->redirect('Price2/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=Price2Model::where('id',$id)->find();
        $this->assign('list',$list); 
        return $this->fetch();
    }


    public function delete()
    {
        $id=$_GET['id'];
        $price=Price2Model::where('id',$id)->find();
        $price->is_delete=Price2Model::$isDelete['yes']['val'];
        if($price->save()){
            $this->redirect('Price2/index');
        }else{
            $this->error('删除失败!');
        }
    }



}