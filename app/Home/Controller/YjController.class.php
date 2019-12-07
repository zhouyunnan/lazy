<?php
namespace Home\Controller;
use Think\Controller;
class yjController extends Controller {

    public function index(){
        $data = array(
            'ailas'=>"盟主",
            "email"=>"164041601@qq.com",
            "title"=>"提醒",
            "htmlbody"=>"今天是个好日子"
        );
        $res = $this->http_curl('http://www.doudianwang.com/API/email/index.php','post','json',$data);
        dump($res);
    }
    
    public function sms(){
        $data = array(
            'phone'=>"17600664494",
            "SignName"=>"兜点网",
            "TemplateCode"=>"SMS_70430379",
            // "pot_data"=> json_encode(
            //     array(
            //         "name"=>"帅哥",
            //         "store"=>"1234"
            //     ),JSON_UNESCAPED_UNICODE
            // )
        );
        $res = $this->http_curl('http://www.doudianwang.com/API/sms/index.php','post','json',$data);
        dump($res);
    }


    public function http_curl($url,$type='get',$res='json',$arr=''){
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