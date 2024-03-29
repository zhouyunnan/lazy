<?php
namespace Home\Controller;
use Think\Controller;
class DingdanController extends Controller {
    public function _initialize()
    {   
        $admin = session("runningMan");
        if(!$admin){
            echo json_encode(array(
                "result" => false,
                "msg"=>"错误，您未登陆"
            ));
            exit();
        }
    } 
    //获取今日订单
    public function today_dd(){
        $tabld_dd = M("dingdan");
        $year=date("Y-m-d");
        $t = strtotime($year);

        $map['createtime']  = array('gt', $t);
        $map['schoolid']  = session("runningMan");
        $map['tz']  = array('neq', "false");
        
        $res = $tabld_dd->where($map)->order("id desc")->select();
       
       if($res){
        echo json_encode(array(
            "result" => true,
            "lists"=>$res
        ));
        exit();
       }else{
        echo json_encode(array(
            "result" => false,
        ));
        exit();
       }
    }
    //删除某一个订单
    public function dele_dd(){
        $tabld_dd = M("dingdan");
        $map['schoolid']  = session("runningMan");
        $map['id']  = I('post.id');

        $res = $tabld_dd->where($map)->delete();
        if($res){
            echo json_encode(array(
                "result" => true,
            ));
            exit();
           }else{
            echo json_encode(array(
                "result" => false,
            ));
            exit();
           }
    }

    //查询订单派送学信息
    public function ddpsxx(){
        $table = M("ddcz");
        $map = array(
            "ddid"=>I('post.id'),
        );
        $res = $table->where($map)->select();
        echo json_encode(array(
            "result" => true,
            "lists"=>$res
        ));
        exit();
    }

    //历史总订单
    public function geralldd(){
        $tabld_dd = M("dingdan");

        $page = I('post.p');
        $num = I('post.pagesize');
        $begin = ($page-1)*$num;

        

        $map['schoolid']  = session("runningMan");
        $map['tz']  = array('neq', "false");
        $res = $tabld_dd->where($map)->order("id desc")->limit($begin,$num)->select();
        $count = $tabld_dd->where($map)->count();
       
       if($res){
        echo json_encode(array(
            "result" => true,
            "lists"=>$res,
            "count"=>$count
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