<?php
namespace app\index\controller;
use think\Controller;
use app\model\SystemModel;
use app\model\AdviceModel;
use think\Session;

class Cooperation extends Controller
{
  public function index(){
    Session::set('title','cooper');
    return view();
  }
}
