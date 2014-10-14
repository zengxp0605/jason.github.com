<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHPExcel 导入文件</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data"> 
    <input type="hidden" name="leadExcel" value="true"> 
    <table align="center" width="90%" border="0">
      <tr>
         <td><input type="file" name="inputExcel" id="inputExcel" ><input type="submit" value="导入数据"></td>
      </tr>
    </table>
</form>
<?php
//include "PHPExcel/Classes/phpExcel/Writer/IWriter.php";
//include "PHPExcel/Classes/phpExcel/Writer/Excel5.php";
//require_once 'PHPExcel/Classes/phpExcel/Writer/Excel2007.php';
require_once '../PHPExcel.php';
//include 'PHPExcel/Classes/phpExcel/IOFactory.php';
 
//设定缓存模式为经gzip压缩后存入cache（PHPExcel导入导出及大量数据导入缓存方式的修改 ） 
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip; 
$cacheSettings = array(); 
PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings); 
 
 $objPHPExcel = new PHPExcel();
 $con = mysql_connect("localhost","root","root");
 mysql_select_db('jiuyang');
//读入上传文件
if($_POST){
    $objPHPExcel = PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
    //内容转换为数组 
    $indata = $objPHPExcel->getSheet(0)->toArray();
    var_dump($indata );
    //excel  sheet个数
    //echo $objPHPExcel->getSheetCount();
   
    //把数据新增到mysql数据库中
    foreach($indata as $item){
        $sql = "insert into px_atest(name,info) values('$item[1]','$item[2]')";
        mysql_query($sql);
    }
}  
//查看是否导入成功
 $sql1="select * from px_atest";
 $query = mysql_query($sql1);
 echo '<hr />';
 while($data = mysql_fetch_array($query)){
      var_dump($data['name']);
     }
?>
</body>
</html>