<?php
/**
 * Created by PhpStorm.
 * User: GroupQian
 * Date: 2018/9/12
 * Time: 16:21
 */

/*class Stack2Queue{
    private  $stack1 = [];
    private  $stack2 = [];

    function mypush($node)
    {
        // write code here
        array_push($this->stack1,$node);
    }
    function mypop()
    {
        // write code here
        while ($this->stack1){
            $pop_value = array_pop($this->stack1);
            array_push($this->stack2,$pop_value);
        }
        $ret = array_pop($this->stack2);
        while ($this->stack2){
            $pop_value = array_pop($this->stack2);
            array_push($this->stack1,$pop_value);
        }
        return $ret;
    }
}
$s = new Stack2Queue();
$s->mypush(2);
$s->mypush(3);
echo $s->mypop();
$s->mypush(4);
$s->mypush(5);
echo $s->mypop();
echo $s->mypop();
echo $s->mypop();
echo $s->mypop();
*/
//反转链表
function ReverseList($pHead)
{
    // write code here
    $p = NULL;
    $p_next = $pHead;
    while($p_next){
        $pHead = $p_next;
        $p_next = $pHead->next;
        $pHead->next = $p;
        $p = $pHead;
    }
    return $pHead;
}
//合并两个有序链表
function Merge($pHead1, $pHead2)
{
    // write code here
    $p1 = $pHead1->next;
    $p2 = $pHead2;
    $pHead3 = $pHead1;
    $p3 = $pHead3;
    while($p1 && $p2){
        if ($p1->val <= $p2->val){
            $p3->next = $p1;
            $p3 = $p1;
            $p1 = $p1->next;

        }else{
            $p3->next = $p2;
            $p3 = $p2;
            $p2 = $p2->next;
        }
    }
    $p3->next = $p1?$p1:$p2;
    return $pHead3;

}
//旋转数组最小值
function minNumberInRotateArray($rotateArray)
{
    // write code here
    if(count($rotateArray) == 0){
        return 0;
    }
    $l = 0;
    $r = count($rotateArray) - 1;
    while($l < $r){
        $mid = floor(($l + $r) / 2);
        if($rotateArray[$mid] > $rotateArray[0]){
            $l = $mid + 1;
        }else{
            $r = $mid;
        }
    }
    return $rotateArray[$l];
}
//O(1)时间复杂度实现栈的最小值
$stack = [];
$stack1 = [];
function mypush($node)
{
    // write code here
    global $stack;
    global $stack1;
    if(empty($stack1) || $node <= end($stack1)){
        array_push($stack1,$node);
    }
    array_push($stack,$node);
}
function mypop()
{
    // write code here
    global $stack;
    global $stack1;
    if(end($stack) == end($stack1)){
        array_pop($stack1);
    }
    return array_pop($stack);
}
function mytop()
{
    // write code here
    global $stack;
    return end($stack);
}
function mymin()
{
    // write code here
    global $stack1;
    return end($stack1);
}
//判断入栈顺序与出栈顺序是否一致
function IsPopOrder($pushV, $popV)
{
    // write code here
    $stack1 = [];
    foreach($pushV as $value){
        if($value == $popV[0]){
            array_shift($popV);
            while(!empty($stack1) && !empty($popV)){
                if(end($stack1) == $popV[0]){
                    array_pop($stack1);
                    array_shift($popV);
                }else{
                    break;
                }

            }
        }else{
            array_push($stack1,$value);
        }
    }
    if(empty($popV)){
        return True;
    }
    return array_reverse($stack1) == $popV;
}
//汉诺塔问题
function haniot($n,$x,$y,$z){
    if($n == 1){
        echo $x . "->" .$z . " ";
    }else{
        haniot($n - 1,$x,$z,$y);
        echo $x . "->" .$z . " ";
        haniot($n - 1,$y,$x,$z);
    }
}
haniot(10,"A","B","C");
//非递归前中后遍历二叉树，python写法
/*
 * 不知道中序和另外一种遍历方法 ，没办法还原二叉树
def preorderTraversal(self, root):
        """
        :type root: TreeNode
        :rtype: List[int]
        """
        if not root:
            return []
        result = []
        stack = []
        stack.append(root)
        while stack:
            cur = stack.pop()
            result.append(cur.val)
            if cur.right:
                stack.append(cur.right)
            if cur.left:
                stack.append(cur.left)
        return result

def inorderTraversal(self, root):
        """
        :type root: TreeNode
        :rtype: List[int]
        """
        result = []
        stack = []
        while root or stack:
            if root:
                stack.append(root)
                root = root.left
            else:
                cur = stack.pop()
                result.append(cur.val)
                root = cur.right
        return result
利用类似先序的特点写后序
def postorderTraversal(self, root):
        """
        :type root: TreeNode
        :rtype: List[int]
        """

        if not root:
            return []
        stack = []
        result = []
        stack.append(root)
        while stack:
            cur = stack.pop()
            result.append(cur.val)
            if cur.left:
                stack.append(cur.left)
            if cur.right:
                stack.append(cur.right)
        return result[::-1]
*/
//递归快排
function partition(&$arr,$l,$h){
    $val = $arr[$l];
    while($l < $h){
        while($l < $h && $arr[$h] >= $val)
            $h--;
        $arr[$l] = $arr[$h];
        while($l < $h && $arr[$l] <= $val)
            $l++;
        $arr[$h] = $arr[$l];
    }
    $arr[$l] = $val;
    return $l;
}
function quick_sort(&$arr,$l,$h){
    if ($l < $h){
        $pos = partition($arr,$l,$h);
        quick_sort($arr,$l,$pos - 1);
        quick_sort($arr,$pos + 1,$h);
    }
}
//归并排序
function merge_sub_array(&$arr,$l,$m,$r){
    //$m = floor(($l + $r) / 2);
    $left_sub_arr = array_slice($arr,$l,$m - $l + 1);
    $right_sub_arr = array_slice($arr,$m + 1,$r - $m);
    $left_sub_arr_size = $m - $l + 1;
    $right_sub_arr_size = $r - $m;
    $i = $j = 0;$k = $l;//分别指向左子数组，右子数组，原始数组
    while($i < $left_sub_arr_size && $j < $right_sub_arr_size){
        if ($left_sub_arr[$i] < $right_sub_arr[$j]){
            $arr[$k] = $left_sub_arr[$i];
            $i++;
            $k++;
        }else{
            $arr[$k] = $right_sub_arr[$j];
            $j++;
            $k++;
        }
    }
    while($i < $left_sub_arr_size){
        $arr[$k] = $left_sub_arr[$i];
        $i++;
        $k++;
    }
    while($j < $right_sub_arr_size){
        $arr[$k] = $right_sub_arr[$j];
        $j++;
        $k++;
    }
}
function merge_sort(&$arr,$l,$r){
    if($l < $r){
        $m = floor(($l + $r) / 2);
        merge_sort($arr,$l,$m);
        merge_sort($arr,$m + 1,$r);
        merge_sub_array($arr,$l,$m ,$r);
    }
}
$arr = [3,-2,4,2,3,4,-34,34,1,34,0,34,-3,-3,2,4];
$b = $arr;
quick_sort($arr,0,count($arr) - 1);
var_dump($arr == sort($b));
//图的bfs
$graph = [
    1 => [2,3],
    2 => [1,4],
    3 => [1,2,4,5],
    4 => [2,3,5,6],
    5 => [3,4],
    6 => [4]
];
function bfs($graph,$start){
    $queue = [$start];
    $seen = [$start];
    while ($queue){
        $cur = array_pop($queue);
        foreach ($graph[$cur] as $node){
            if(!in_array($node,$seen)){
                array_unshift($queue,$node);
                array_unshift($seen,$node);
            }
        }
        print($cur);
    }
}
//dfs
function dfs($graph,$start){
    $stack = [$start];
    $seen = [$start];
    while ($stack){
        $cur = array_pop($stack);
        foreach ($graph[$cur] as $node){
            if(!in_array($node,$seen)){
                array_push($stack,$node);
                array_unshift($seen,$node);
            }
        }
        print($cur);
    }
}
bfs($graph,5);
//dijkstra,根据bfs的思路改写的，php的spl优先队列是大顶堆，而这里我们的优先队列需要从小到大排，所以只好用一个数组模拟，每次插入之后，再排序一下。。
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