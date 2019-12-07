<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Runman;

class XrunmanController extends Controller {
    //根据ID查询跑男
    public function find_byid(){
        $runman = new Runman();
        $runman_ = $runman->find_byid(I('post.school_id'));
        if($runman_){
            echo json_encode(array(
                "result" => true,
                "content"=>array(
                    "id"=>$runman_['id'],
                    "phone"=>$runman_['phone'],
                    "schoolname"=>$runman_['schoolname'],
                    "yingyezt"=>$runman_['yingyezt'],
                    "jiedanshijian"=>$runman_['jiedanshijian'],
                    "guandianshijian"=>$runman_['guandianshijian'],
                    "gonggao"=>$runman_['gonggao'],

                )
            ));
            exit();
        }else{
            echo json_encode(array(
                "result" => false,
            ));
            exit();
        }
    }
}
