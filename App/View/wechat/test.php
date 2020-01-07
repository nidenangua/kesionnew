<?php
//
//$list["a"] = ['aa'=>77,'bb'=>88,'cc'=>79];
//$list["1"]=['aa'=>77,'bb'=>88,'cc'=>89];
//var_dump($list);
//
////var_dump($list);
//foreach ($list as &$v){
//    $list[]['aa']=10;
//
//}
//
//$list['dd']=10;
////unset($v);
////$list['dd']=841;
//var_dump($list);

//$pro_arr = array(
//    array('price' =>10 , 'count' => 100 ),
//    array('price' =>20 , 'count' => 40 ),
//     array('price' =>20 , 'count' => 30 ),
//    array('price' =>20 , 'count' => 50 ) ,
//    array('price' =>20 , 'count' => 60 )
//
//);
//foreach($pro_arr as $val){
//    echo $val['price'].'-'.$val['count'];
//    echo '<br/>';
//}
//不用再用一个新的数组来存放结果 这里直接插入到旧的数组 变成新的数组
//foreach ($pro_arr as &$val) {
//    $val['total']=$val['price']*$val['count'];
//    $val['bb']=77;
//}
//unset($val);
//var_dump($pro_arr);
//foreach($pro_arr as $val){
//    echo $val['price'].'-'.$val['count'].'-'.$val['total'];
//    echo '<br/>';
//}


//$a= 7;
//注意是多等号
//for($i = 0;$i<=10;$i++){
//
//   if($i == 3)return;
//  echo $i;
//}
//echo "aaa";
//for ($x=0; $x<=10; $x++) {
//    echo "数字是：$x <br>";
//}


//for($num = 2;$num <=10;$num++){
//    if($num == 4){
//        continue; //跳过这个 直接下一个
//       // break; //中断打印 后面的都不打印
//    }
//    echo "数字是：$num <br>";
//}

$area = array(
    array('id'=>1,'name'=>'安徽','parent'=>0),
    array('id'=>2,'name'=>'海淀','parent'=>7),
    array('id'=>3,'name'=>'濉溪县','parent'=>5),
    array('id'=>4,'name'=>'昌平','parent'=>7),
    array('id'=>5,'name'=>'淮北','parent'=>1),
    array('id'=>6,'name'=>'朝阳','parent'=>7),
    array('id'=>7,'name'=>'北京','parent'=>0),
    array('id'=>8,'name'=>'上地','parent'=>2)
);

function subtree($arr,$id=0,$lev=1) {
    $subs = array(); // 子孙数组
    foreach($arr as $v) {
        if($v['parent'] == $id) {
            $v['lev'] = $lev;
            $subs[] = $v; // 举例说找到array('id'=>1,'name'=>'安徽','parent'=>0),
            $subs = array_merge($subs,subtree($arr,$v['id'],$lev+1));
        }
    }
    return $subs;
}
$tree = subtree($area,0,1);
var_dump($tree);
foreach($tree as $v) {
    echo str_repeat('  ',$v['lev']),$v['name'],'<br />';
}

//function tree($arr,$id) {
//    $tree = array();
//    while($id !== 0) {
//        foreach($arr as $v) {
//            if($v['id'] == $id) {
//                $tree[] = $v;
//                $id = $v['parent'];
//                break;
//            }
//        }
//    }
//    return $tree;
//}
//print_r(tree($area,0));


$a = date('Y-m-d H:i:s',1508213557);
var_dump($a);






