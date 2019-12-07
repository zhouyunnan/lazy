<?php
namespace Home\Controller;
use Think\Controller;
class XdingdanController extends Controller {

    //查询待配送订单
    public function getdd(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $table = M('dingdan');
        $map['md5openid'] = array("eq",session('openid'));
        $map['tz'] = array("eq","true");
        $map['paisongtime'] = array("eq",0);
        $map['wanchengtime'] = array("eq",0);
        $lists = $table->field(array("id","createtime","shouhuodizhi","paisongtime","paisongtime","quhuohao"))->where($map)->order("id desc")->select();
        echo json_encode(array(
            "result" => false,
            "lists"=> $lists
        ));
        return;
    }

    //查询配送中订单
    public function peisongz(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $table = M('dingdan');
        $map['md5openid'] = array("eq",session('openid'));
        $map['tz'] = array("eq","true");
        $map['paisongtime'] = array("neq",0);
        $map['wanchengtime'] = array("eq",0);
        $lists = $table->field(array("id","createtime","shouhuodizhi","paisongtime","paisongtime","quhuohao"))->where($map)->order("id desc")->select();
        echo json_encode(array(
            "result" => false,
            "lists"=> $lists
        ));
        return;
    }
        //查询完成订单
        public function wancdd(){
            if(!session("?openid")){
                //操作失败，记录数据库
                echo json_encode(array(
                    "result" => false,
                    "msg"=> "登录超时"
                ));
                return;
            }
            $page = I('post.p');
            $num = I('post.pagesize');
            $begin = ($page-1)*$num;


            $table = M('dingdan');
            $map['md5openid'] = array("eq",session('openid'));
            $map['tz'] = array("eq","true");
            $map['paisongtime'] = array("neq",0);
            $map['wanchengtime'] = array("neq",0);

            $lists =  $table->field(array("id","createtime","shouhuodizhi","paisongtime","wanchengtime","quhuohao"))->where($map)->order("wanchengtime desc")->limit($begin,$num)->select();

            if($lists){
                echo json_encode(array(
                    "result" => true,
                    "lists"=> $lists
                ));
                return;
            }else{
                echo json_encode(array(
                    "result" => false,
                ));
                return;
            }
        }

}