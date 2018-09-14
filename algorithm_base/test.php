<?php
/**
 * Created by PhpStorm.
 * User: GroupQian
 * Date: 2018/9/12
 * Time: 17:45
 */
/*class ListNode{
    var $val;
    var $next = NULL;
    function __construct($x){
        $this->val = $x;
    }
}

$arr = [1,2,3,4,5];
$head1 = new ListNode(0);
$head2 = new ListNode(0);
$p1 = $head1;
$p2 = $head2;
foreach ($arr as $value){
    $p1->next = new ListNode($value);
    $p1 = $p1->next;
    $p2->next = new ListNode($value + 5);
    $p2 = $p2->next;
}
Merge($head1, $head2);
*/
//$handle = fopen("php://stdin","r");
//$n = fgets($handle);
//$graph = [];
//for ($i = 0;$i < $n;$i++){
//    $graph[$i + 1] = explode(" ",fgets($handle));
//}
$graph = [
    'A' => [
        'B' => 5,
        'C'=> 1
    ],
    'B' => [
        'A' => 5,
        'C' => 2,
        'D' => 1
    ],
    'C' => [
        'A' => 1,
        'B' => 2,
        'D' => 4,
        'E' => 8
    ],
    'D' => [
        'B' => 1,
        'C' => 4,
        'E' => 3,
        'F' => 6
    ],
    'E' => [
        'C' => 8,
        'D' => 3
    ],
    'F' => [
        'D' => 6
    ]
];
function dijsktra($graph,$start){
    $priority_queue = [];//优先队列，记录当前需要遍历的点
    $records = [];//记录某个点的父节点，以及从开始节点经过父节点到该节点的最短路径
    $seen = [];//已经遍历的点
    //初始化records
    foreach (array_keys($graph) as $vertex){
        if ($vertex != $start)
            $records[$vertex] = ["",INF];
        else
            $records[$vertex] = ["",0];
    }
    //初始化队列
    $priority_queue[] = [$start,0];
    while ($priority_queue){
        $node = array_shift($priority_queue);
        $vertex = $node[0];
        $dist = $node[1];
        $seen[] = $vertex;
        foreach ($graph[$vertex] as $k => $v){
            if (!in_array($k,$seen)){
                if ($dist + $graph[$vertex][$k] < $records[$k][1]){
                    //更新优先队列
                    $priority_queue[] = [$k,$dist + $graph[$vertex][$k]];
                    usort($priority_queue,function($a,$b){
                        if ($a[1] == $b[1])
                            return 0;
                        return $a[1] > $b[1]?1:-1;
                    });
                    //更新这个节点的父节点以及距离
                    $records[$k][0] = $vertex;
                    $records[$k][1] = $dist + $graph[$vertex][$k];
                }
            }
        }
    }
    return $records;
}
function print_least_path($graph,$s,$e){
    $records = dijsktra($graph,$s);
    echo "min_path:{$records[$e][1]} \n";
    $res = [$e];
    $s = $records[$e][0];
    while ($s){
        $res[] = $s;
        $s = $records[$s][0];
    }
    echo "path is :" . implode("->",array_reverse($res));
}
print_least_path($graph,'B','A');