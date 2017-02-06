<?php

$arr=[33,11,2,55,94,5,32,19,68,23];

//快速排序
//选择一个基准元素、通常选择第一个或者最后一个元素
//通过一趟扫描、将待排序分成两部分、一部分比基准元素小、另一部分比基准元素大
//
function quickSort($arr){
	//判断是否需要排序
	$count=count($arr);
	if($count <= 1)
		return $arr;

	//选择一个元素作为基准，这里拿第一个
	$base=$arr[0];

	//初始化两个数组
	$left=[];//比基准元素小的
	$right=[];//比基准元素大的

	//遍历除基准元素外的所有元素、按照大小关系放到两个数组内
	for($i=1;$i<$count;$i++){//$i=1 因为第0个被用作基准元素
		//比基准元素小的放到左边
		if($base > $arr[$i]){
			$left[]=$arr[$i];
		//比基准元素大的放到右边
		}else{
			$right[]=$arr[$i];
		}
	}

	$left=quickSort($left);
	$right=quickSort($right);

	return array_merge($left,[$base],$right);
}

// print_r(bubbleSort($arr));


//冒泡排序
//在要排序的数组中、从前往后对相邻的两个数一次进行比较和调整
//让较小的数往上冒、较大的数往下沉
//每当两相邻的数比较后发现他们的顺序与排序要求相反时、将他们互换
function bubbleSort($arr){
	//判断是否需要排序
	$count=count($arr);
	if($count <= 1)
		return $arr;

	//循环需要冒泡的轮数
	for($i=0;$i<$count;$i++){
		
		for($j=0;$j<$count-$i-1;$j++){

			//相邻数比较、如果第一个大于第二个就互换位置、总之前面的要小于后面的
			if($arr[$j] > $arr[$j+1]){
				$min=$arr[$j+1];
				$arr[$j+1]=$arr[$j];
				$arr[$j]=$min;
			}

		}
	}

	return $arr;
}


print_r(bubbleSort($arr));
