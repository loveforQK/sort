<?php
/**
 * 冒泡排序
 */
trait Maopao{
    public function start(array $array = []){
        $len = count($array);
        for($i = 0;$i < $len - 1;$i++){
            for($j = 0;$j < $len - 1;$j++){
                //遇到相邻左大右小交换
                if($array[$j] > $array[$j+1]){
                    $temp = $array[$j+1];
                    $array[$j+1] = $array[$j];
                    $array[$j] = $temp;
                }
            }
        }
        return $array;
    }
}

/**
 * 选择排序
 */
trait Xuanze{
    public function start(array $array = []){
        $len = count($array);
        for($i = 0;$i < $len-1;$i++){
            $minIndex = $i;
            for($j = $i+1;$j < $len;$j++){
                if($array[$j] < $array[$minIndex]){
                    $minIndex = $j;//交换键
                }
            }

            //根据键值交换数值
            $temp = $array[$i];
            $array[$i] = $array[$minIndex];
            $array[$minIndex] = $temp;
        }
        return $array;
    }
}

/**
 * 插入排序
 */
trait Charu{
    public function start(array $array = []){
        $len = count($array);
        for($i=1;$i<$len;$i++){
            $preindex = $i-1;
            $current = $array[$i];
            //左面比自己的大右移
            while($preindex >= 0 && $array[$preindex] > $current){
                $array[$preindex+1] = $array[$preindex];
                $preindex--;
            }

            //左移
            $array[$preindex+1] = $current;
        }

        return $array;
    }
}

/**
 * 快速排序
 */
trait Quaisu{
    public function start(array $array = []){
        $len = count($array);
        if($len <= 1){
            return $array;
        }

        $base_num = $array[0];
        $left_array = $right_array = [];
        for($i=1;$i<$len;$i++){
            if($array[$i] > $base_num){
                $right_array[] = $array[$i];
            }else{
                $left_array[] = $array[$i];
            }
        }

        //递归分组
        $left_array = $this->d($left_array);
        $right_array = $this->d($right_array);

        //合并数组
        return array_merge($left_array,[$base_num],$right_array);
    }
}

class Sort{
    private $array = [];

    //引入多个trait，同时设置别名
    use Maopao,Xuanze,Charu,Quaisu{
        //先覆盖同名方法
        Maopao::start insteadof Xuanze;
        Maopao::start insteadof Charu;
        Maopao::start insteadof Quaisu;
        //定义别名
        Maopao::start as a;
        Xuanze::start as b;
        Charu::start as c;
        Quaisu::start as d;
    }

    public function __construct(array $array){
        $this->array = $array;
    }

    public function output($type){
        return $this->$type($this->array);
    }
}

$sort = new Sort([32,2,45,12,34,10,78,1,21,90]);

echo '<h2>冒泡</h2>';
echo implode(',',$sort->output('a'));
echo '<br/>';


echo '<h2>选择</h2>';
echo implode(',',$sort->output('b'));
echo '<br/>';

echo '<h2>插入</h2>';
echo implode(',',$sort->output('c'));
echo '<br/>';

echo '<h2>快速</h2>';
echo implode(',',$sort->output('d'));
echo '<br/>';