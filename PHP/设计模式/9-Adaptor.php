<?
/*======================
	������ģʽ
========================*/
// �������˴���
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
// ����һ��������
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
echo '����:',$_weather['temp'],'<br />';
echo '����:',$_weather['wind'],'<br />';
echo 'sun: ',$_weather['sun'],'<br />';
echo '<hr />';
// ��ʱ����һ���ֻ�java �ͻ���,����ʶphp ���л��������
// ���޸ķ���˴���,��ɵĿͻ��˻��ܵ�Ӱ��..

//[��������һ��������]

// ���Ӻ���������
$_weather = AdapterWeather::show();
$_weather = json_decode($_weather,true);
echo '����:',$_weather['temp'],'<br />';
echo '����:',$_weather['wind'],'<br />';
echo 'sun: ',$_weather['sun'],'<br />';

?>