<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Excle 导出文件</title>
    </head>
    <body>
        <?php
        require_once '../PHPExcel.php';
        require_once "../PHPExcel/Writer/IWriter.php";
//include "../PHPExcel/Writer/Excel5.php";//用于低版本excel
        require_once '../PHPExcel/Writer/Excel2007.php'; //用于2007excel
//include 'PHPExcel/Classes/phpExcel/IOFactory.php';
// Create new PHPExcel object 
        //echo date('H:i:s') . " Create new PHPExcel object\n";
        $objPHPExcel = new PHPExcel();

// Set properties 
        //echo date('H:i:s') . " Set properties\n";
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
        $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
//$objPHPExcel->getProperties()->setDescrīption("Test document for Office 2007 XLSX, generated using PHP classes."); 
        $objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
        $objPHPExcel->getProperties()->setCategory("Test result file");

// Add some data 
        //echo date('H:i:s') . " Add some data\n";
        $con = mysql_connect("localhost", "root", "root");
        mysql_select_db("jiuyang");
        $sql = "select * from px_atest";
        $query = mysql_query($sql);

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Info');
        $i = 2;
        while ($data = mysql_fetch_array($query)) {

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data['info']);
            $i ++;
        }

// Rename sheet 
        //echo date('H:i:s') . " Rename sheet\n";
        $objPHPExcel->getActiveSheet()->setTitle('Simple');  // sheetName
// Set active sheet index to the first sheet, so Excel opens this as the first sheet 
        $objPHPExcel->setActiveSheetIndex(0);

// Save Excel 2007 file 
        //echo date('H:i:s') . "Write to Excel2007 format\n";
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $FileName = (str_replace('.php', '.xls', __FILE__));
        //$objWriter->save($FileName);
        

// Redirect output to a clients web browser (Excel5)通知下载  
ob_end_clean();//清除缓冲区,避免乱码
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="订单汇总表(' . date('Ymd-His') . ').xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;  
        
        
        
// echo done 
        echo date('H:i:s') . " Done writing file.\r\n";
        var_dump('ok,ok!');
        ?>
    </body>
</html>