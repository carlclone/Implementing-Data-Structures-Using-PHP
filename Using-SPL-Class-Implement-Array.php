<?php

//非PHP数组(实际是HashTable) , 数据结构中的数组,比PHP数组占用更少的空间
$startMemory = memory_get_usage();

//SplFixedArray创建大小为100的数组
$array = new SplFixedArray(100);
for ($i = 0; $i < 100; $i++)
    $array[$i] = new SplFixedArray(100);

echo memory_get_usage() - $startMemory, ' bytes';
