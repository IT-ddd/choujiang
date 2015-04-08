<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type:text/html;charset=utf-8");
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    
    public function run(){
    	$prize_arr=array();
    	$arr0 = array('id' => 1,'praisefeild' => 'first','praisename' => '一等奖','min' => '1','max' => '29','praisecontent' => 'iphone5s土豪金一部','praisenumber' => -1,'chance' => 1);
    	$arr1 = array('id' => 2,'praisefeild' => 'second','praisename' => '二等奖','min' => '302','max' => '328','praisecontent' => 'ipadmini','praisenumber' => -1,'chance' => 2);
    	$arr2 = array('id' => 3,'praisefeild' => 'Third','praisename' => '三等奖','min' => '242','max' => '268','praisecontent' => '现金500','praisenumber' => -1,'chance' => 5);
    	$arr3 = array('id' => 4,'praisefeild' => 'Fourth','praisename' => '四等奖','min' => '182','max' => '208','praisecontent' => '现金300','praisenumber' => -1,'chance' => 7);
    	$arr4 = array('id' => 5,'praisefeild' => 'Fifth','praisename' => '五等奖','min' => '122','max' => '148','praisecontent' => '现金200','praisenumber' => -1,'chance' => 10);
    	$arr5 = array('id' => 6,'praisefeild' => 'Sixth','praisename' => '六等奖','min' => '62','max' => '88','praisecontent' => '现金100','praisenumber' => -1,'chance' => 25);
    	$arr6 = array('id' => 7,'praisefeild' => 'Seventh','praisename' => '七等奖','min' => '32,92,152,212,272,332','max' => '58,118,178,238,298,358','praisecontent' => '小熊宝宝一个','praisenumber' => -1,'chance' => 50);
    	$arr = Array($arr0,$arr1,$arr2,$arr3,$arr4,$arr5,$arr6);
    	
    	foreach($arr as $key=>$val){
    		$min=explode(",",$val['min']);
    		$max=explode(",",$val['max']);
    		if(count($min)>1){
    			$val['min']=$min;
    		}
    		if(count($max)>1){
    			$val['max']=$max;
    		}
    		$prize_arr[$key]=$val;
    	}
    	echo $this->getResult($prize_arr);
    }
    
    private function getResult($priearr){
    	$arr=array();
    	$count=array();
    	foreach ($priearr as $key => $val) {
    		$arr[$val['id']] = $val['chance'];
    		$count[$val['id']] = $val['praisenumber'];
    	}
    	$rid = $this->getRand($arr,$count); //根据概率获取奖项id
    	$res = $priearr[$rid-1]; //中奖项
    	
    	$min = $res['min'];
    	$max = $res['max'];
    	if(is_array($min)){ //多等奖的时候
    		$i = mt_rand(0,count($min)-1);
    		$result['angle'] = mt_rand($min[$i],$max[$i]);
    	}else{
    		$result['angle'] = mt_rand($min,$max); //随机生成一个角度
    	}
    	$result['praisename'] = $res['praisename'];
    	
    	return $this->json($result);
    }
    private function getRand($proArr,$proCount){
    	$result = '';
    	$proSum=0;
    	//概率数组的总概率精度  获取库存不为0的
    	foreach($proCount as $key=>$val){
    		if($val==0){
    			continue;
    		}else{
    			$proSum=$proSum+$proArr[$key];
    		}
    	}
    	//概率数组循环
    	foreach($proArr as $key => $proCur){
    		if($proCount[$key]==0){
    			continue;
    		}else{
    			$randNum = mt_rand(1,$proSum);//关键
    			if ($randNum <= $proCur){
    				$result = $key;
    				break;
    			}else{
    				$proSum -= $proCur;
    			}
    		}
    	}
    	unset($proArr);
    	return $result;
    }
    private function json($array){
    	$this->arrayRecursive($array,'urlencode',true);
    	$json = json_encode($array);
    	return urldecode($json);
    }
    //对数组中所有元素做处理
    private function arrayRecursive(&$array,$function,$apply_to_keys_also = false){
    	foreach($array as $key => $value) {
    		if (is_array($value)) {
    			arrayRecursive($array[$key],$function,$apply_to_keys_also);
    		}else{
    			$array[$key] = $function($value);
    		}
    		if ($apply_to_keys_also && is_string($key)){
    			$new_key = $function($key);
    			if ($new_key != $key){
    				$array[$new_key] = $array[$key];
    				unset($array[$key]);
    			}
    		}
    	}
    }
}