<?php
namespace app\index\controller;
use think\Controller;
use app\model\SystemModel;
use app\model\CooperationModel;
use think\Session;

class Cooperation extends Controller
{
  public function index(){
    Session::set('title','cooper');
    $list=CooperationModel::where('id',1)->find();
    return view("",compact('list'));
  }
}
