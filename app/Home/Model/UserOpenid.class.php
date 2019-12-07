<?php

namespace Home\Model;

//openid表
class UserOpenid{

    //查询该用户是否存在表中
    public function getuser($openid){
        $map = array(
            "openid"=>$openid
        );
        $re = M("user_openid")->where($map)->find();
        return $re;
    }

    //把用户openID存入数据库
    public function adddata($openid){
        $data = array(
            "openid"=>$openid,
            "time"=>date("Y-m-d H:i:s",time()),
            "md5openid"=>md5($openid),
            "for"=>"WX"
        );
        $table = M("user_openid");
        $re = $table->add($data);
        return;
    }

    //通过加密的openid查询
    public function getopenid($md5openid){
        $map = array(
            "md5openid"=>$md5openid
        );
        $re = M("user_openid")->where($map)->find();
        return $re;
    }

    //判断地址是否发生变化
    public function dizhi($city,$district){
      $table = M("user_openid");
      $map = array(
          "md5openid"=>session('openid'),
          "city"=>$city,
          "district"=>$district
      );
      $re = $table->where($map)->find();
      if($re){
        return true;
      } else{
          return false;
      }
    }
    //通过会话更新信息
    public function save($data){
      $table = M("user_openid");
      $map = array(
          "md5openid"=>session('openid')
      );
      $re = $table->where($map)->save($data);
      if($re){
        return true;
      } else{
          return false;
      }
    }
    //判断选定的学校是不是现在的学校，防止重复更改
    public function sc_zx($school_id){
        $table = M("user_openid");
        $map = array(
            "md5openid"=>session('openid'),
            "schoolid"=>$school_id,
        );
        $re = $table->where($map)->find();
        if($re){
            return true;
        } else{
            return false;
        }
    }
}
