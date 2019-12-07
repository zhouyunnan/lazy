<?php
namespace Home\Controller;
use Think\Controller;   
class MbController extends Controller {
    
    //登录
     public function _initialize()
     {   
        header("Access-Control-Allow-Origin: http://a.com"); // 允许a.com发起的跨域请求
        //如果需要设置允许所有域名发起的跨域请求，可以使用通配符 *
        header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
         $admin = session("Mb");
         if(!$admin){
            $user = I("post.user");
            $password = I("post.pas");
            $table = M("runningMan");
            $map = array(
                "account" => $user,
                "password" => $password
            );
            $re = $table->where($map)->find();
            if($re){
                session("Mb",$re['id']);
            }else{
                echo json_encode(array(
                    "result" => false,
                    "msg"=>"未登录！"
                ));
                exit();
            }
         }
     } 
     //查询订单
     public function jrdqj(){
        $tabld_dd = M("dingdan");
        $year=date("Y-m-d");
        $t = strtotime($year);
        $map_count['createtime']  = array('gt', $t);
        
        $map_count['schoolid']  = array('eq', session("Mb"));
        $map_count['tz']  = array('neq', "false");

        $lists = $tabld_dd ->where($map_count)->order("id asc")->select();

        if(count($lists)>0){

            $count = [];
            for($j = 0; $j<count($lists);$j++){
                $count[] = array(
                    "id"=>$lists[$j]['id'],
                    "createtime"=>$lists[$j]['createtime'],
                    "shouhuoren"=>$lists[$j]['shouhuoren'],
                    "lianxidianhua"=>$lists[$j]['lianxidianhua'],
                    "shouhuodizhi"=>$lists[$j]['shouhuodizhi'],
                    "paisongtime"=>$lists[$j]['paisongtime'],
                    "wanchengtime"=>$lists[$j]['wanchengtime'],
                    "tz"=>$lists[$j]['tz'],
                    "num"=>$j+1,
                ); 
            }


            $arr = [];
            $type = I('post.type');
            if($type == 'dqj'){
                for($i = 0; $i < count( $count); $i++){
                    if(($count[$i]['paisongtime'] == "0") && ($count[$i]['wanchengtime'] == '0')){
                        $arr[] = array(
                            "id"=>$count[$i]['id'],
                            "createtime"=>$count[$i]['createtime'],
                            "shouhuoren"=>$count[$i]['shouhuoren'],
                            "lianxidianhua"=>$count[$i]['lianxidianhua'],
                            "shouhuodizhi"=>$count[$i]['shouhuodizhi'],
                            "tz"=>$count[$i]['tz'],
                            "num"=>$count[$i]['num'],
                            "paisongtime"=>$count[$i]['paisongtime'],
                            "wanchengtime"=>$count[$i]['wanchengtime'],
                        );
                    }
                }
            }
            if($type == 'dps'){
                for($i = 0; $i < count( $count); $i++){
                    if(($count[$i]['paisongtime'] != "0") && ($count[$i]['wanchengtime'] == '0')){
                        $arr[] = array(
                            "id"=>$count[$i]['id'],
                            "createtime"=>$count[$i]['createtime'],
                            "shouhuoren"=>$count[$i]['shouhuoren'],
                            "lianxidianhua"=>$count[$i]['lianxidianhua'],
                            "shouhuodizhi"=>$count[$i]['shouhuodizhi'],
                            "tz"=>$count[$i]['tz'],
                            "num"=>$count[$i]['num'],
                            "paisongtime"=>$count[$i]['paisongtime'],
                            "wanchengtime"=>$count[$i]['wanchengtime'],
                        );
                    }
                }
            }
            if($type == 'ywc'){
                for($i = 0; $i < count( $count); $i++){
                    if(($count[$i]['paisongtime'] != "0") && ($count[$i]['wanchengtime'] != '0')){
                        $arr[] = array(
                            "id"=>$count[$i]['id'],
                            "createtime"=>$count[$i]['createtime'],
                            "shouhuoren"=>$count[$i]['shouhuoren'],
                            "lianxidianhua"=>$count[$i]['lianxidianhua'],
                            "shouhuodizhi"=>$count[$i]['shouhuodizhi'],
                            "tz"=>$count[$i]['tz'],
                            "num"=>$count[$i]['num'],
                            "paisongtime"=>$count[$i]['paisongtime'],
                            "wanchengtime"=>$count[$i]['wanchengtime'],
                        );
                    }
                }
            }


            echo json_encode(array(
                "result" => true,
                "lists" => $arr
            ));
            return;
        }  
        echo json_encode(array(
            "result" => false,
            "msg"=>"没有查询到订单"
        ));









      
     }

     public function getdd(){
        $id = I('post.id');
        $table = M('dingdan');
        $map = array(
            'id' => $id,
            "schoolid"=>session('Mb'),
        );
        $re = $table->field(array("id","tz","shouhuoren","createtime","paisongtime","wanchengtime","shouhuodizhi","lianxidianhua","quhuohao","kuaidigongsi","shangloufuwu","kuaididaxiao","tebiebeizhu","quhuodidian","huowumingcheng","qujianshijian","songdashijian","out_trade_no"))->where($map)->find();
        $psy = $this->paisy();
        if($re){
            echo json_encode(array(
                "result" => true,
                "content"=>$re,
                "psys"=>$psy
            ));
            return;
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=> "查询失败"
            ));
            return;
        }
    }
    //查询派送员
    public function paisy(){
        $table = M('paisongyuanMan');
        $map = array(
            "manid"=>session('Mb'),
        );
        $lists = $table->where($map)->select();
        return $lists;
    }

    //取件 - 、更改订单状态，记录取件时间，推送短信通知
    public function  qujianle(){
        $id = I('post.id');
        $table = M('dingdan');
        $map = array(
            'id' => $id,
            "schoolid"=>session('Mb'),
        );
        $data = array(
            "paisongtime"=>time()
        );
        $re = $table->where($map)->save($data);
        //发送短信通知用户
        $this->sendsms($id);

        if(isset($_POST['use']) && !empty($_POST['use'])){
            $this->ddcazj($id,I('post.use'),"qujian");
        }

        if($re){
            echo json_encode(array(
                "result" => true,
                "msg"=> "取件成功"
            ));
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=> "取件失败"
            ));
        }
    }
    //添加订单操作记录
    public function ddcazj($ddid,$user,$type){
        $table = M('ddcz');
        $data = array(
            "ddid"=>$ddid,
            "type"=>$type,
            "use"=>$user
        );
        $re= $table->add($data);
        return;
    }
    private function sendsms($id){
        $table = M('dingdan');
        $map = array(
            'id' => $id,
        );
        $ddxx = $table->where($map)->find();
        $phone = $ddxx['lianxidianhua'];
        if(!$phone){
            return;
        }else{
            $data = array(
                'phone'=>$phone,
                "SignName"=>"兜点网",
                "TemplateCode"=>"SMS_179155498"
            );
            $res = $this->http_curl('http://www.doudianwang.com/API/sms/index.php','post','json',$data);
            return;
        }
    }

    //完成订单
    public function  wancl(){
        $id = I('post.id');
        $table = M('dingdan');
        $map = array(
            'id' => $id,
            "schoolid"=>session('Mb'),
        );
        $data = array(
            "wanchengtime"=>time()
        );
        $re = $table->where($map)->save($data);
        if(isset($_POST['use']) && !empty($_POST['use'])){
            $this->ddcazj($id,I('post.use'),"wancheng");
        }

        if($re){
            echo json_encode(array(
                "result" => true,
                "msg"=> "操作成功"
            ));
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=> "操作失败"
            ));
        }
    }
    private function http_curl($url,$type='get',$res='json',$arr=''){
        //1.初始化curl
        $ch  =curl_init();
        //2.设置curl的参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "media=@test.jpg");

        if($type == 'post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        }
        //3.采集
        $output =curl_exec($ch);

        //4.关闭
        curl_close($ch);

        if($res=='json'){
            if(curl_error($ch)){
                //请求失败，返回错误信息
                return curl_error($ch);
            }else{
                //请求成功，返回错误信息
                return json_decode($output,true);
            }
        }
        echo var_dump( $output );
    }



    //查询店铺信息
    public function getpaonan(){
        $table = M("runningMan");
        $map = array(
            "id" =>  session("Mb")
        );
        $re = $table->where($map)->find();
        echo json_encode(array(
            "result"=>true,
             "content"=>$re
        ));

    }
    public function changegg(){
        $table = M("runningMan");
        $map = array(
            "id" =>  session("Mb")
        );
        $data = array(
            'gonggao'=>I('post.gonggao')
        );
        $re = $table->where($map)->save($data);
        if($re){
            echo json_encode(array(
                "result"=>true
           ));
        }else{
            echo json_encode(array(
                "result"=>false
           ));
        }     
    }
    
    public function kaiye(){
        $table = M("runningMan");
        $map = array(
            "id" =>  session("Mb")
        );
        $data = array(
            'yingyezt'=> "true"
        );
        $re = $table->where($map)->save($data);
        if($re){
            echo json_encode(array(
                "result"=>true
           ));
        }else{
            echo json_encode(array(
                "result"=>false
           ));
        }     
    }
    
    public function guanmen(){
        $table = M("runningMan");
        $map = array(
            "id" =>  session("Mb")
        );
        $data = array(
            'yingyezt'=> "false"
        );
        $re = $table->where($map)->save($data);
        if($re){
            echo json_encode(array(
                "result"=>true
           ));
        }else{
            echo json_encode(array(
                "result"=>false
           ));
        }     
    }
}