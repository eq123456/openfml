<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
  public function _initialize() {
    if (!$_SESSION['user']) {
      //$this->redirect('User/sign_in');
    }
  }
  public function index(){
    // var_dump($_GET['cart_key']);
    /*
    if (!$_GET['cart_key'] || (!$_GET['username'] && $_SESSION['user'])) {
        
      if ($_SESSION['user']){
        $target['username'] = $_SESSION['user']['username'];
      }
      $target['cart_key'] = cookie('cart_key');

      //$this->redirect('?'.http_build_query($target));
    }
    */
    $this->display();
    R('Corn/index');
    R('Cart/getCartKey');
    var_dump(cookie('cart_key'));
  }
  public function order(){
    $model_order = D('receipt_order');
    $model_entry = D('entry');

    $map_order['uid'] = $_SESSION['user']['id'];
    $map_entry['order_id'] = '';

    if ($_SESSION['user']['role'] != 'admin') {
        $map_entry['receiver_uid'] = $_SESSION['user']['id'];
    }

    $list_order = $model_order->where($map_order)->select();
    $list_entry = $model_entry
      ->where($map_entry)->order('status_name, time_created')->select();

    $output['order'] = $list_order;
    $output['entry'] = $list_entry;

    $this->output = $output;
    $this->display();
    //var_dump($list_entry);
    //var_dump($list_order);
  }
  public function order_bug(){
    $model_order = D('receipt_order');
    $model_entry = D('receipt_entry');

    $map_order['uid'] = $_SESSION['user']['id'];
    $map_entry['order_id'] = '';
    $map_entry['uid'] = $_SESSION['user']['id'];

    $list_order = $model_order->where($map_order)->select();
    $list_entry = $model_entry->where($map_entry)->select();

    $output['order'] = $list_order;
    $output['entry'] = $list_entry;

    $this->output = $output;
    $this->display();
    //var_dump($list_entry);
    //var_dump($list_order);
  }


}