<?
/*======================
	适配器模式
========================*/
// 服务器端代码
class Weather{
	public static function show(){
		$_wea = array(
			'temp'=>28,
			'wind'=>7,
			'sun'=>'sunny',
		);
		
		return serialize($_wea);
	}
}
// 增加一个适配器
class AdapterWeather extends Weather{
	public static function show(){
		$_wea = parent::show();
		$_aryWea = unserialize($_wea);
		$_json = json_encode($_aryWea);
		return $_json;
	}
}


$_weather = unserialize(Weather::show());
//var_dump($_weather);
echo '气温:',$_weather['temp'],'<br />';
echo '风力:',$_weather['wind'],'<br />';
echo 'sun: ',$_weather['sun'],'<br />';
echo '<hr />';
// 此时来了一批手机java 客户端,不认识php 序列化后的数据
// 若修改服务端代码,则旧的客户端会受到影响..

//[可以增加一个适配器]

// 增加后再来调用
$_weather = AdapterWeather::show();
$_weather = json_decode($_weather,true);
echo '气温:',$_weather['temp'],'<br />';
echo '风力:',$_weather['wind'],'<br />';
echo 'sun: ',$_weather['sun'],'<br />';

?>