<?php

use Swoole\Table;

// 创建内存表
$table = new swoole_table(65536);

// 内存表增加一行
$table->column('id', $table::TYPE_INT, 8);
$table->column('name', $table::TYPE_STRING, 64);
$table->column('age', $table::TYPE_INT, 4);

$table->create();

// 插入数据, 增加一条记录
$table->set('1', ['id' => 1, 'name' => 'songyaofeng', 'age' => 666]);
$table['test2'] = [
    'id' => 2,
    'name' => '张三丰',
    'age' => 100
];
$table->incr('test2', 'age', 33);
print_r($table->get('test2'));

echo '开始删除：' . PHP_EOL;
$table->del('test2');

print_r($table['test2']);