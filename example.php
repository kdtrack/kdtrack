<?php

include 'KuaidiAPI.php';

//修改成你自己的KEY
$key = 'c684ab43a28bc3caea53570666ce9762'; 

$kuaidichaxun = new KuaidiAPi($key);

//设置返回格式。 0: 返回 json 字符串; 1:返回 xml 对象
//$kuaidichaxun->setShow(1); //可选，默认为 0 返回json格式

//返回物流信息条目数。 0:返回多行完整的信息; 1:只返回一行信息
//$kuaidichaxun->setMuti(1); //可选，默认为0

//设置返回物流信息排序。desc:按时间由新到旧排列; asc:按时间由旧到新排列
//$kuaidichaxun->setOrder('asc');

//查询
$result = $kuaidichaxun->query('111111', 'quanfengkuaidi');

//带公司短码查询，短码列表见文档
//$result = $kuaidichaxun->query('111111', 'quanfengkuaidi');

//111111 快递单号
//quanfengkuaidi   快递公司名称


var_dump($result);
