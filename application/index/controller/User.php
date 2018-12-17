<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
class User extends Controller{
	
	public function login() {
		return $this -> fetch();
	}
	
	public function doLogin(Request $request){
		$user = $request->param();
		$admin = Db('admin')->where($user)->find();
		if($admin == null){
			return json_encode(1);
		}else{
			session('admin',$admin);
			return json_encode(0);
		}
	}
	public function logout(){
		$this -> success('退出成功',url('User/login'));
	}
	
}
