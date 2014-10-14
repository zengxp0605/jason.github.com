<?php
		

		$memcache = new Memcache();
		if(!$memcache->connect('127.0.0.1',11211)){ //连接 
			die('连接失败！');
		}

		$brr = array(
				'row1' => array('a1'=>'a','a2'=>'aa','a3'=>'aaa')
				,'row2' => array('b1'=>'b','b2'=>'bb','b3'=>'bbb')
				,'row3' => array('c','cc','ccc')
			);



		$_return = $memcache->set('brr',$brr,MEMCACHE_COMPRESSED,0);

		var_dump($_return,$memcache->get('brr'));
		
        exit;
		echo "<hr/><hr/>";

		// 存入的数组如何操作??? || 先整体取出, 改变值后再set
		$_tmpArr = $memcache->get('brr');

		$_tmpArr['row1']['a1'] = 'CHANGED!!!!';

		$_return = $memcache->set('brr',$_tmpArr , false , 300 );
		
		var_dump($_return,$memcache->get('brr'));
		echo "<hr/><hr/><hr/>";
		
		$prize = array(
				'0'=>array('name'=>'1等奖','cur_count'=>0, 'max'=>100)
				,'1'=>array('name'=>'2等奖','cur_count'=>0, 'max'=>200)
				,'2'=>array('name'=>'3等奖','cur_count'=>0, 'max'=>300)
				,'3'=>array('name'=>'4等奖','cur_count'=>0, 'max'=>400)
				,'4'=>array('name'=>'5等奖','cur_count'=>0, 'max'=>500)

			);

		
		var_dump('原始的----',$prize);
		
		// 将每个数组元素存入到 mem
		$return = true;
		foreach($prize as $key => $val){
			foreach($val as $k => $v){
				$return = $return && ($memcache->set('prize'. $key . $k , $v ,false ,0));

			}
		}
		
		var_dump($return);

		$rand_key = mt_rand(0,4);

		$cur_count = $memcache->get('prize'.$rand_key .'cur_count');
		$memcache->set('prize'.$rand_key .'cur_count', $cur_count+55,false ,0);
		
		

		foreach($prize as $key => $val){
			foreach($val as $k => $v){
				var_dump('prize'. $key . $k ,$memcache->get('prize'. $key . $k , $v));

			}
			echo "<hr/>";
		}

		
	
?>