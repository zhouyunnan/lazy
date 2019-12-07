<?php
namespace Home\Controller;
use Think\Controller;
class ErrorController extends Controller {
 
    public  function add(){
        $table = M("err");
        $data = array(
            "time"=>time(),
            "msg"=>I('get.e')
        );
        dump($data);
        $re = $table->add($data);
        return;
    }
}