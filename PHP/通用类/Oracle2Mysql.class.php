<?php

function test1() {
    //var_dump( strpos( 'INSERT INTO "USER_ESERVICE"','INSERT'));
    $str = "10130696047', TO_DATE('2013-12-25 19:42:58', 'YYYY-MM-DD HH24:MI:SS'), '10130706607',";
     $str = preg_replace('/^(.*)TO_DATE\((\'\d{4}-\d\d-\d\d \d\d:\d\d:\d\d\'),[^\)]+\)(.*)$/i', '${1} UNIX_TIMESTAMP(${2}) ${3}', $str);
    var_dump($str);
    $string = 'April 15, 2003';
    $pattern = '/(\w+) (\d+), (\d+)/i';
    $replacement = '${1}1,${3}';
    echo preg_replace($pattern, $replacement, $string);
    exit;
}

//test1();
/**
 * 转换 oracle的sql 文件为mysql 可用的sql
 */
class Oracle2Mysql {

    protected $_oracleFilePath;
    protected $_mysqlFilePath;
    protected $_oldDbName;

    public function __construct($oracleFilePath, $mysqlFilePath, $oldDbName = '') {
        $this->_oracleFilePath = $oracleFilePath;
        $this->_mysqlFilePath = $mysqlFilePath;
        if ($oldDbName) { // 需要将sql 中的旧数据库名称替换
            $this->_oldDbName = $oldDbName;
        }
    }

    /**
     *  保存mysql 的sql 文件
     */
    public function save() {
        $fp = fopen($this->_oracleFilePath, 'r');
        $fsave = fopen($this->_mysqlFilePath, 'w');
        $_lines = '';
        $_tmpStr = '';
        $_maxLine = 1000;
        $_i = 0;
        while (!feof($fp)) {
            $_i++;
            $_tmpStr = fgets($fp, 20480);
            $_tmpStr = $this->_processOneline($_tmpStr);
            $_lines .= $_tmpStr;
            if ($_i % $_maxLine == 0) { // 每读取1000 行写入一次文件
                fwrite($fsave, $_lines);
                $_lines = '';
                //break;
            }
        }
        // 最后再写入一次
        //fwrite($fsave,'\n\n\n-----------\n\n\n');
        fwrite($fsave, $_lines);
        fclose($fp);
        fclose($fsave);
        return true;
    }

    /**
     *  处理一行sql 语句
     * @param type $str
     */
    private function _processOneline($str) {
        if ($this->_oldDbName) { // 替换掉原来的数据库名
            $str = str_replace("\"{$this->_oldDbName}\".", '', $str);
        }
        // 插入语句的处理
        if (strpos($str, 'INSERT') === 0) {
            $str = preg_replace('/^insert\s?into\s?"([a-z0-9-_]+)"\s?VALUES(.*)$/i', 'insert into `${1}` VALUES${2}', $str);
            // 处理特殊函数 TO_DATE
            if(strpos($str, 'TO_DATE(') !== false){
                $str = preg_replace('/TO_DATE\((\'\d{4}-\d\d-\d\d \d\d:\d\d:\d\d\'),[^\)]+\)/i', 'UNIX_TIMESTAMP(${1})', $str);
            }
            
        } else if (strpos($str, 'CREATE') === 0) {
            // 创建表的语句
            $str = str_replace('"', '`', $str);
        } else if (strpos($str, 'DROP') === 0) {
            // 删除表的语句
            $str = str_replace(array('"', 'DROP TABLE'), array('`', 'DROP TABLE IF EXISTS'), $str);
        } else if (strpos($str, 'COMMENT') === 0) {
            // 备注语句
            $str = ''; // 暂时不要备注
        } else if (strpos($str, 'LOGGING') ===0 
                || strpos($str, 'NOCOMPRESS') ===0 
                ||  strpos($str, 'NOCACHE') ===0 ) {// 其他语句
            $str = '';
        } else {
            $_seach = array('"', ' NUMBER ',' NUMBER(', ' DATE ');
            $_replace = array('`', ' int ',' int(', ' int ');
            $str = str_replace($_seach, $_replace, $str);
            if (strpos($str, 'VARCHAR2') !== false) {
                $str = preg_replace('/^(.*)VARCHAR2\((\d+)\s?\w+\)(.*)$/i', '${1} varchar(${2}) ${3}', $str);
            }
              // 处理特殊函数 TO_DATE
            if(strpos($str, 'TO_DATE(') !== false){
                $str = preg_replace('/TO_DATE\((\'\d{4}-\d\d-\d\d \d\d:\d\d:\d\d\'),[^\)]+\)/i', 'UNIX_TIMESTAMP(${1})', $str);
            }
        }
        return $str;
    }

}

// 读取文件测试
$_t1 = microtime(true);
$_filepath = './EXAM_PAPER.sql'; // oracle 导出的sql 文件
$_savefile = './save.sql';   // 保存成的 mysql.sql 文件
$m = new Oracle2Mysql($_filepath, $_savefile, 'USER_ESERVICE');
$m->save();
//$_len = file_put_contents(,$_rs,FILE_APPEND);
$_t2 = microtime(true);
echo ($_t2 - $_t1), ' end';
?>