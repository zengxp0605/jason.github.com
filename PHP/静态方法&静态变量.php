<?php

class user {

    private static $count = 0; //记录所有用户的登录情况.
    public static $users;

    public function __construct($username = 'undefinded') {
        self::$count = self::$count + 1;
        self::$users[] = $username;
    }

    public function getCount() {
        return self::$count;
    }

    public function __destruct() {
        //echo '<br />__destruct<br />';
        self::$count = self::$count - 1;
    }

}

$user1 = new user('user1');
$user2 = new user('user2');
$user3 = new user('user3');
$user4 = new user();
$user5 = new user();
echo "now here have " . $user1->getCount() . " user";
echo "<br>";
unset($user3);
echo "now here have " . $user1->getCount() . " user";
print_r(user::$users);
echo '<hr />';
echo '----------------------------------------------<br/>';

Class A {

    public $a = 'I am A';

    public function write() {
        echo 'I can be overriden!<br />';
    }

    public static function no_write() {
        echo 'Can I be overriden?<br />';
    }

}

Class B extends A {

    public function write() {
        echo 'Override from A successfully!<br />';
    }

    public static function no_write() {
        echo 'Can I override successful?<br />';
    }

}

$a = new A;
$a->write();
$a->no_write();

$b = new B;
echo $b->a . '<br />';  //Attributes can be inherited
$b->write();
$b->no_write();       //static methods can be overriden

exit;

?>