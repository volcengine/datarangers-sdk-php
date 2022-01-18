<?php

phpinfo();

echo "hello world!\r\n";
var_dump("a" > "b");
var_dump("a");

print("a \r\n");
echo preg_replace_callback('~-([a-z])~', function ($match) {
    return strtoupper($match[1]);
}, 'hello-world');

echo "===\r\n";

class SubObject
{
    public static $instances = 0;
    public $instance;

    public function __construct()
    {
        $this->instance = ++SubObject::$instances;
    }

    public function __clone()
    {
        $this->instance = ++SubObject::$instances;
    }
}

class MyCloneable
{
    public $object1;
    public $object2;

    function __clone()
    {
        // clone
        $this->object1 = clone $this->object1;
    }
}

$obj = new MyCloneable();
$obj->object1 = new SubObject();
$obj->object2 = new SubObject();
$obj2 = clone $obj;
print("Original Object:\n");
print_r($obj);

print("Cloned Object:\n");
print_r($obj2);

print("obj == obj2:\n");
print($obj === $obj2);
print("   \r\n");
print("seialize:\n");
//$seaObj = new MyCloneable();
$sea = serialize($obj2);
print_r($sea);

print("\r\nunseialize:\n");
print_r(unserialize($sea));
echo "==============\r\n";
$i = 1;
while ($i <= 10) {
    echo $i++ . " ";
}

for ($i = 1; $i <= 10; $i++) {
    echo "this is " . $i;
}

$array = array(1, "2a", 2, 3);
foreach ($array as $ele) {
    print_r($ele);
}

var_dump($array);

class foo
{
    function do_foo()
    {
        print("Doing foo.\r\n");
    }
}

$bar = new foo;
$bar->do_foo();

unset($bar);
echo "aaf \r\n";
// 回调函数示范
function my_callback_function()
{
    echo 'hello world my_callback_function!';
}

// 类型 1：简单的回调
call_user_func('my_callback_function');

function test(bool $str)
{

}

test((boolean)true);

$foo = 'Bob';              // 将 'Bob' 赋给 $foo
$bar = $foo;              // 通过 $bar 引用 $foo

echo "\r\n";
echo $bar;
echo "\r\n";
echo $foo;                 // $foo 的值也被修改
echo "\r\n";

$foo = "My name is $bar";  // 修改 $bar 变量
$bar = &$foo;              // 通过 $bar 引用 $foo
echo $bar;
echo "\r\n";
echo $foo;                // $foo 的值也被修改
echo "\r\n";
$a = "a" . "b";
echo "$a\r\n";

var_dump((int)($a instanceof string));
/* 故意文件错误 */
$my_file = @file('non_existent_file') or
die ("Failed opening file: error was '" . error_get_last()['message'] . "'");

// 这适用于所有表达式，而不仅仅是函数：
$value = @$cache[$key];
// 如果索引 $key 不存在，则不会发出通知。

