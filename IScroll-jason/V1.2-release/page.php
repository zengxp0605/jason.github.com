<?php

$_page = $_REQUEST['page'];
//if($_page > 1)
	sleep(1);
$_data = null;
if($_page<=7){
	for($i=1;$i<=15;$i++){
		$_data['rows'][]="Page {$_page} -- {$i}";
	}
}
$rs = array(
'status'=>1,
'info'=>'success',
'data'=>$_data,
);

echo json_encode($rs);
?>