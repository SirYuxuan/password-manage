<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller {
	public function index() {
		$admin = session('admin');
		if ($admin == null) {
			$this -> error('您还尚未登陆,请先登陆', url('User/login'));
		}
		return $this -> fetch();
	}

	public function pwdList() {
		$admin = session('admin');
		if ($admin == null) {
			return array('code' => 1, 'msg' => '尚未登陆,请刷新登陆');
		}
		$uid = $admin['id'];
		$where = array('uid' => $uid,'del'=>'0');
		$count = db('pass') -> where($where) -> count();
		$list = db('pass') -> order('id desc') -> where($where) -> page(input('page'),input('limit'))-> select();
		return array('code'=>0,'msg'=>'','count'=>$count,'data'=>$list);
	}
	
	public function addPass(){
		$admin = session('admin');
		if ($admin == null) {
			return array('code' => 1, 'msg' => '尚未登陆,请刷新登陆');
		}
		$uid = $admin['id'];
		$add = request()->param();
		$add['uid'] = $uid;
		db('pass')->insert($add);
		return json_encode(1);
		
	}
	
	public function del(){
		$id = input('id');
		db('pass')->where(array('id'=>$id))->update(array('del'=>'1'));
	}

}
