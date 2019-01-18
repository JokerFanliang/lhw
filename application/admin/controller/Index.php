<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
class Index extends common
{

    public function index()
    {
        $this->redirect('Editmanager/manager');
    }

    public function loginout()

    {   
        Session::pull('uname');
        $this->redirect('Login/login');
    }


}