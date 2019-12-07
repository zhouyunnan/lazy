<?php

namespace Home\Model;

//useinfo表
class userinfo{
    //把用户openID存入数据库
    public function adddata($data){
        $table = M("user_userinfo");
        $re = $table->add($data);
        return $re;
    }

    //查询是否存在
    public function finddata(){
        $table = M("user_userinfo");
        $map = array(
            "md5openid"=>session("openid"),
        );
        $re = $table->where($map)->find();
        if($re){
            return $re;
        }else{
            return false;
        }
    }


}