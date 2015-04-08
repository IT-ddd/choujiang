# choujiang
Thinkphp3.2.3抽奖程序

一、入口文件

// 定义应用目录

define('APP_PATH','./Apps/');

// 定义运行时目录

define('RUNTIME_PATH','./Runtime/');

// 开启调试模式

define('APP_DEBUG',True);

// 更名框架目录名称，并载入框架入口文件

require './Think/ThinkPHP.php';

二、修改配置文件config.php

1.修改choujiang\Apps\Common\Conf目录下的config.php文件
return array(

	//'配置项'=>'配置值'
	
	'DEFAULT_MODULE' => 'Home', //默认模块
	
	'URL_MODEL' => '2', //URL模式
	
	'SESSION_AUTO_START' => true, //是否开启session
	
	'TMPL_FILE_DEPR' => '_',//模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符
	
	'TMPL_L_DELIM' => '{|',//模板引擎普通标签开始标记
	
	'TMPL_R_DELIM' => '|}'//模板引擎普通标签结束标记
	
);

2.修改choujiang\Apps\Home\Conf目录下的config.php文件

return array(

	//'配置项'=>'配置值'
	
	'TMPL_PARSE_STRING' => array(
	
		'__PUBLIC__' => __ROOT__ . '/Public/Home'
		
	),
	
);


三、模板文件制作

模板存放路径：

choujiang\Apps\Home\View

模板名称：

Index_index.html

模板中引入的css,js,img文件路径：

choujiang\Public\Home


四、模板显示

修改choujiang\Apps\Home\Controller路径下的IndexController.class.php文件

修改如下：


IndexController.class.php文件中的run方法实现了抽奖功能



更多精彩内容敬请关注微信公众号：IT-ddd
