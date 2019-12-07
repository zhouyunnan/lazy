<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\curlModel;
use Home\Model\UserOpenid;
use Home\Model\userinfo;
use Home\Model\Runman;
class XLoginController extends Controller {

    //用于返回会话ID 然后小程序存储
    public  function sess(){
        session("dn","user");
        echo json_encode(array(
            "result" => true,
        ));
    }
    //处理登录，获取用户的openid
    //开启一次新的登录
    public function get_user_object(){
        $JSCODE = (string)I('get.code');
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.C("APPID").'&secret='.C("SECRET").'&js_code='.$JSCODE.'&grant_type=authorization_code';
        $curl = new curlModel();
        $res = $curl->http_curl($url,'get');
       
        if(isset($res["openid"])){
            $openid = $res["openid"];
            

            //记录opened
            $useropenid = new UserOpenid();
            $user_re = $useropenid->getuser($openid);
            if(!isset($user_re) || empty($user_re)){
                $user_re = $useropenid->adddata($openid);
            }

            //把openid加密存入会话，并且返回
            session("openid",md5($openid));

            $school_id = ""; //学校ID
            $city = ""; //城市
            $district = "";//区

            if(isset($user_re)){
                $school_id = $user_re['schoolid'];
                $district = $user_re['district'];
                $city = $user_re['city'];
            }

             //判断是否已经记录了用户的详细详细
             $userinfo = new userinfo();
             $finddata = $userinfo->finddata();
             if($finddata){
                 echo json_encode(array(
                     "result" => true,
                     "openid"=> md5($openid),
                     "userinfo"=>array(
                        "nickName"=>$finddata["nickName"],
                        "avatarUrl"=>$finddata["avatarUrl"],
                     ),
                     "school_id"=>$school_id,
                     "district"=>$district,
                     'city'=>$city
                 ));
             }else{
                 echo json_encode(array(
                     "result" => true,
                     "openid"=> md5($openid),
                     "userinfo"=>false,
                     "school_id"=>$school_id,
                     "district"=>$district,
                     'city'=>$city
                 ));
             }

        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=> "No openid"
            ));
        }
        

    
    }
    
    //记录用户所在位置
    public function save_wz(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $useropenid = new UserOpenid();


        $city = I('post.city');
        $district = I('post.district');
        
        $zx = $useropenid->dizhi($city,$district);
        if(!$zx){
            $data = array(
                "city"=>$city,
                "district"=>$district
            );
            $useropenid->save($data);
        }

        //查询该城市开通了的学校
        $runman = new Runman();
        $lists = $runman->find_bycity($city);
        echo json_encode(array(
            "result" => true,
            "lists"=>$lists
        ));
        return;

    }
    //记录用户所在学校
    public function save_school(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $useropenid = new UserOpenid();
        $school_id = I('post.school_id');
        $sc_zx = $useropenid->sc_zx($school_id);
        if(!$sc_zx){
            $data = array(
                "schoolid"=>$school_id,
            );
            $useropenid->save($data);
        }
        echo json_encode(array(
            "result" => true,
        ));
        return;
    }
    //处理用户的详细XX、存入数据库
    public function userinfo(){
        if(!session("?openid")){
            //操作失败，记录数据库
            echo json_encode(array(
                "result" => false,
                "msg"=> "登录超时"
            ));
            return;
        }
        $openidObj = new UserOpenid();
        $openid = $openidObj->getopenid(session("openid"));

        $data = array(
            "openid"=>$openid["openid"],
            "avatarUrl"=>I('post.avatarUrl'),
            "nickName"=>I('post.nickName'),
            "time"=>date("Y-m-d H:i:s",time()),
            "md5openid"=>session("openid"),
        );

        $userinfo = new userinfo();
        $finddata = $userinfo->finddata();

        if(!$finddata){
            $re = $userinfo->adddata($data);
            if($re){
                echo json_encode(array(
                    "result" => true,
                    "msg"=> "add ok."
                ));
            }else{
                echo json_encode(array(
                    "result" => false,
                    "msg"=> "add fail."
                ));
            }
        }else{
            echo json_encode(array(
                "result" => false,
                "msg"=> "It already exists."
            ));
        }
        






    }
    
    //查询学校列表
    public function getschool_s(){
        $pn = new Runman();
        $res = $pn->sec();
        echo json_encode(array(
            "result" => true,
            "lists" => $res
        ));
        return;
    }
  
        



}




