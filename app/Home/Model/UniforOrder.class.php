<?php
namespace Home\Model;

//UniforOrder表 统一下单结果
class UniforOrder{

    public function adddata($data){
        $table = M("unifororder");
        $re = $table->add($data);
        return;
    }
}