<?php
namespace Home\Controller;
use Think\Controller;
class ProfileController extends Controller {
    public function index(){
        if(!$_SESSION['user']) {
            $this->error('请先登录', U('/Access/login'));
        } else {
            $this->display();
        }
    }
    public function order(){
      if (!$_SESSION['user']) {
        $this->redirect('sign_in');
      }
    }
}