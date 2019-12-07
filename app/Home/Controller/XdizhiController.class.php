<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\curlModel;
class XdizhiController extends Controller {
 
    public function  adddizhi(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $table = M('dizhi');
        $moren = "false";
        if(!$this->gerdd()){
            $moren = "true";
        };

        $data = array(
            "md5openid" => session('openid'),
            "phone"=>I('post.phone'),
            "dizhi"=>I('post.dizhi'),
            "name"=>I('post.name'),
            "moren"=>$moren,
        );
        $re = $table->add($data);
        if($re){
            echo json_encode(array(
                "result" => true,
                "msg"=> "成功"
            ));
            return;
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=> "添加失败"
            ));
            return;
        }
    }
    public function getall(){
        $lists = $this->gerdd();
        echo json_encode(array(
            "lists"=> $lists
        ));
        return;
    }

    //查询地址列表
    public function gerdd(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $table = M('dizhi');
        $map = array(
            "md5openid" => session("openid")
        );
        $lists = $table->where($map)->select();
        if($lists){
            return $lists;
        }else{
            return false;
        }
    }
    public function dele(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $table = M('dizhi');
        $map = array(
            "md5openid" => session("openid"),
            "id" => I('post.id')
        );
        $re = $table->where($map)->delete();
        if($re){
            echo json_encode(array(
                "result" => true,
            ));
            return;
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"删除失败"
            ));
            return;
        }
    }
    //设为默认
    public function moren(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $table = M('dizhi');
        $map1 = array(
            "md5openid" => session("openid"),
        );
        $data1 = array(
            "moren"=>"false"
        );
        $re1 = $table->where($map1)->save($data1);
        $map2 = array(
            "md5openid" => session("openid"),
            "id" => I('post.id')
        );
        $data2 = array(
            "moren"=>"true"
        );
        $re2 = $table->where($map2)->save($data2);
        if($re2){
            echo json_encode(array(
                "result" => true,
                "msg"=>"设置成功"
            ));
            return;
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"删除失败"
            ));
            return;
        }
    }
    //返回默认地址
    public function dizhimr(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $table = M('dizhi');
        $map = array(
            "md5openid" => session("openid"),
            "moren"=>"true"
        );
        $res = $table->where($map)->find();
        if($res){
            echo json_encode(array(
                "result" => true,
                "content"=> $res
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
