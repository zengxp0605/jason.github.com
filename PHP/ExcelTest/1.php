<?php

header("Content-Type: text/html; charset=utf-8");

require_once './PHPExcel.php';
require_once './PHPExcel/IOFactory.php';
require_once './PHPExcel/Reader/Excel5.php';

/**
 * 	导出数据为excel表格
 * 	@param $data    一个二维数组,结构如同从数据库查出来的数组
 * 	@param $title   excel的第一行标题,一个数组,如果为空则没有标题
 * 	@param $filename 下载的文件名
 * 	@examlpe 
  exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
 */
function exportexcel($data = array(), $title = array(), $filename = 'report') {
    header("Content-type:application/octet-stream");
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=" . $filename . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    //导出xls 开始
    if (!empty($title)) {
        foreach ($title as $k => $v) {
            $title[$k] = iconv("UTF-8", "GB2312", $v);
        }
        $title = implode("\t", $title);
        echo "$title\n";
    }
    if (!empty($data)) {
        foreach ($data as $key => $val) {
            foreach ($val as $ck => $cv) {
                $data[$key][$ck] = iconv("UTF-8", "GB2312", $cv);
            }
            $data[$key] = implode("\t", $data[$key]);
        }
        echo implode("\n", $data);
    }
}
$arr = array(array('id'=>1, 'xuefei'=>"50万以下" ), array('id'=>2, 'xuefei'=>"51万~60万" ));
exportexcel($arr,array('id','账户','密码'),'234');
?>