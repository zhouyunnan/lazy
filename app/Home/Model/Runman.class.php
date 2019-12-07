<?php

namespace Home\Model;

//跑男表
class Runman{
     ///跑男消息修改
     public function updata($data){
        $table = M('runningMan');
        $map = array(
            "id" =>  session("runningMan")
        );
        $re = $table->where($map)->save($data);
        if($re){
            return true;
        }else{
            return false;
        }
    }
    //跑男电话修改
    public function updata_dh($data){
        $table = M('phoneMan');
        $map = array(
            "manid" =>  session("runningMan")
        );
        $re = $table->where($map)->save($data);
        if($re){
            return true;
        }else{
            return false;
        }
    }
    
    //根据城市去查询
    public function find_bycity($city){
        $table = M("runningMan");
        $map = array(
            "city"=>$city
        );
        $res = $table->field("id,schoolname")->where($map)->select();
        return $res;
    }
    //根据ID去查询
    public function find_byid($id){
        $table = M('runningMan');
        $map = array(
            "id" => $id
        );
        $re = $table->where($map)->find();
        if($re){
            return $re;
        }else{
            return false;
        }
    }
    //全部查询
    public function sec(){
        $table = M('runningMan');
        $lists = $table->field("id,schoolname")->select();
        return $lists;
    }
}