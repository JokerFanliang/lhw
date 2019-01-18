<?php
namespace app\admin\controller;
use think\Controller;
class common extends Controller
{
    public function __construct()
    {
       parent::__construct();

       if(!session('?uname'))
       {
          $this->error('您还没有登录，先去登录吧','admin/Login/login');
       }


    }

}
