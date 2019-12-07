<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\wxpayclass;
use Home\Model\Runman;

 
class XxiadanController extends Controller {

    //获取页面表单数据
    public function getfrom(){
        $manid = I('post.id');
        $table = M('bd');
        $map = array(
            "mainid"=>$manid
        );
        $lists = $table->where($map)->select();
        if($lists){
            echo json_encode(array(
                "result" => true,
                "lists" => $lists
            ));
            exit();
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=>"商家未配置页面表单"
            ));
            exit();
        }
    }   
    //预下单
    public function yuxiadan(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        
        $wxpayclass = new wxpayclass();
        $out_trade_no = $wxpayclass->getMillisecond(); 
        $out_trade_no = $out_trade_no.$wxpayclass->getNonceStr(2);

        $table = M('dingdan');
        $data = I('post.');
        $data['md5openid'] = session('openid');
        $data['createtime'] = time();
        $data['paisongtime'] = "0";
        $data['wanchengtime'] = "0";
        $data['tz'] = "false";
        $data['out_trade_no'] = $out_trade_no;
        $re = $table->add($data);
        if($re){
            echo json_encode(array(
                "result" => true,
                "id"=>$re
            ));
            return;
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=> "下单失败"
            ));
            return;
        }
    }
    //查询订单
    public function getdd(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $id = I('post.id');
        $table = M('dingdan');
        $map = array(
            'id' => $id,
            "md5openid"=>session('openid'),
        );
        $re = $table->field(array("id","tz","shouhuoren","createtime","paisongtime","wanchengtime","shouhuodizhi","lianxidianhua","quhuohao","kuaidigongsi","shangloufuwu","kuaididaxiao","tebiebeizhu","quhuodidian","huowumingcheng","qujianshijian","songdashijian","out_trade_no","schoolid"))->where($map)->find();
        if($re){
            echo json_encode(array(
                "result" => true,
                "content"=>$re
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
    //删除订单
    public function deledd(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $id = I('post.id');
        $table = M('dingdan');
        $map = array(
            'id' => $id,
            "md5openid"=>session('openid'),
            "tz"=>"false"
        );
        $re = $table->where( $map)->delete();
        echo json_encode(array(
            "result" => true,
        ));
        return;
    }
    //确认订单 通知跑男
    public function querendd(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $ddid = I('post.id');
        $tabld_dd = M("dingdan");
        $map_dd = array(
            "id" => $ddid,
            "md5openid"=>session('openid'),
        );
        $find_dd = $tabld_dd->where($map_dd)->find();
        if(!$find_dd){
            echo json_encode(array(
                "result" => false,
                "msg"=> "提交失败"
            ));
            return;
        }
        $data = array(
            "tz" => "true"
        );
        $re_up = $tabld_dd->where($map_dd)->save($data);

        if($re_up){
            
            //邮件通知跑男
            $this->tzpn_email($find_dd['schoolid'],$ddid,$find_dd);
            //短信通知跑男
            $this->tzpn_sms($find_dd['schoolid']);


            echo json_encode(array(
                "result" => true,
            ));
            return;
        }else{
            echo json_encode(array(
                "result" => false,
            ));
            return;
        }
    }

    //短信通知
    private function tzpn_sms($pnid){
        $table  = M('phoneMan');
        $map = array(
            "manid"=> $pnid
        );
        $re = $table->where($map)->find();
        if(isset($re['jieshou']) && ($re['jieshou'] == 'true') && isset($re['phone'])){
            $this->send_sms($re['phone']);
        }
        return;
    }
    private function send_sms($phone){
        $data = array(
            'phone'=>$phone,
            "SignName"=>"兜点网",
            "TemplateCode"=>"SMS_178766286",
            // "pot_data"=> json_encode(
            //     array(
            //         "name"=>"帅哥",
            //         "store"=>"1234"
            //     ),JSON_UNESCAPED_UNICODE
            // )
        );
        $res = $this->http_curl('http://www.doudianwang.com/API/sms/index.php','post','json',$data);
        return;
    }
    //取消订单   
    public function quxiaodd(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }  
        $id = I('post.id');
        $table = M('dingdan');
        $map = array(
            'id' => $id,
            "md5openid"=>session('openid'),
        );
        $data = array(
            "tz"=>"quxiao"
        );
        $re = $table->where( $map)->save($data);
        if($re){
            echo json_encode(array(
                "result" => true,
            ));
            $find_dd = $table->where($map)->find();
            $this->tzpn_email_qx($find_dd);
            //邮件通知跑男
            return;
        }else{
            echo json_encode(array(
                "result" => false,
            ));
        }
    }

    //邮件通知跑男
    private function tzpn_email($pnid,$ddid,$dingdandata){
        //查询是否开启了邮件通知
        $yjtzdis = $this->disemail($pnid);
        if(!$yjtzdis){
            return;
        }

        //邮件
        $table_email = M("emailMan");
        $map_email = array(
            "manid"=> $pnid
        );
        $emails = $table_email->where($map_email)->select();
        if(count($emails)>0){
            $email_str = $emails[0]['email'];

            for($i = 1; $i<count($emails);$i++){
                $email_str = $email_str.",".$emails[$i]['email'];
            };
            //发送邮件
            $this->sendemail($email_str,$this->getddnum($pnid),$dingdandata);
        }
        return;
    }
    private function sendemail($email,$num,$dingdandata){
        $pn = new Runman();
        $re_pn = $pn->find_byid($dingdandata['schoolid']);

        $data = array(
            'ailas'=>"盟主",
            "email"=>$email,
            "title"=>"[".$num."]"."新订单来啦！",
            "htmlbody"=>'<a href="tel:'.$dingdandata['lianxidianhua'].'">'.$dingdandata['lianxidianhua'].'</a><br/>'.$dingdandata['shouhuodizhi']."<br/><a href='https://api.doudianwang.com/#/?u=".$re_pn['account']."&p=".$re_pn['password']."'>点击查看</a>",
        );
        $res = $this->http_curl('http://www.doudianwang.com/API/email/index.php','post','json',$data);
        return;
    }
    //取消订单通知
    private function tzpn_email_qx($dingdandata){
        //查询是否开启了邮件通知
        $pnid = $dingdandata['schoolid'];

        $yjtzdis = $this->disemail($pnid);
        if(!$yjtzdis){
            return;
        }

        //邮件
        $table_email = M("emailMan");
        $map_email = array(
            "manid"=> $pnid
        );
        $emails = $table_email->where($map_email)->select();
        if(count($emails)>0){
            $email_str = $emails[0]['email'];

            for($i = 1; $i<count($emails);$i++){
                $email_str = $email_str.",".$emails[$i]['email'];
            };
            //发送邮件
            $this->sendemail_qx($email_str,$dingdandata);
        }
        return;
    }
    private function sendemail_qx($email,$dingdandata){
        $data = array(
            'ailas'=>"盟主",
            "email"=>$email,
            "title"=>"订单取消通知",
            "htmlbody"=>$dingdandata['shouhuoren']."-".$dingdandata['lianxidianhua']."-".$dingdandata['shouhuodizhi'],
        );
        $res = $this->http_curl('http://www.doudianwang.com/API/email/index.php','post','json',$data);
        return;
    }

    //当前第几个订单
    private function getddnum($pnid){
        $tabld_dd = M("dingdan");
        $year=date("Y-m-d");
        $t = strtotime($year);
        $map_count['createtime']  = array('gt', $t);
        $map_count['schoolid']  = array('eq', $pnid);
        $map_count['tz']  = array('neq', "false");
        $count = $tabld_dd ->where($map_count)->count();
        return $count;
    }
    //是否开启了邮件通知
    private function disemail($id){
        $table = M('runningMan');
        $map = array(
            "id"=>$id
        );
        $re = $table->where($map)->find();
        if($re['youxiangtongzhi'] == 'true'){
            return true;
        }else{
            return false;
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
}