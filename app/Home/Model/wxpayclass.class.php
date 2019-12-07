<?php
namespace Home\Model;
class wxpayclass{
   /**
	 * 
	 * 产生随机字符串，不长于32位
	 * @param int $length
	 * @return 产生的随机字符串
	 */
	public static function getNonceStr($length = 32) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		} 
		return $str;
	}
  	/**
	 * 获取毫秒级别的时间戳
	 */
	public static function getMillisecond()
	{
		//获取毫秒的时间戳
		$time = explode ( " ", microtime () );
		$time = $time[1] . ($time[0] * 1000);
		$time2 = explode( ".", $time );
		$time = $time2[0];
		return $time;
    }
    	
	/**
	 * 格式化参数格式化成url参数
	 */
	public function ToUrlParams($arr)
	{
		$buff = "";
		foreach ($arr as $k => $v)
		{
			if($k != "sign" && $v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}
		
        $buff = trim($buff, "&");
        return $buff;
	}
		
	/**
	 * 生成签名
	 * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
	 */
	public function MakeSign($arr,$key)
	{
		//签名步骤一：按字典序排序参数
		ksort($arr);
        $string = $this->ToUrlParams($arr);
		//签名步骤二：在string后加入KEY
		$string = $string . "&key=".$key;
		//签名步骤三：MD5加密
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$result = strtoupper($string);
		return $result;
    }
    
     /**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
	public static function Init($xml)
	{	
		$obj  = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		$json = json_encode($obj);
		$arr  = json_decode($json, true);
		return $arr;
    }
}