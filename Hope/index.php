<?php

// Kickstart the framework
$f3=require('lib/base.php');

$js_scripts = ['ui/src/jquery.js','ui/src/bootstrap.min.js','ui/src/main.js','ui/src/map.js'];

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

// Load configuration
$f3->config('lib/config.ini');


//load our sql database


$f3->set('DB',new DB\SQL('sqlite:data/data.sqlite'));






/*$db->begin();
//$db->exec("CREATE TABLE site (revision INT AUTO_INCREMENT,content LONGTEXT,PRIMARY KEY(revision))");




$db->commit();*/

//$db->exec("INSERT INTO site (revision,content) VALUES (0,'call')");

//$var_full = $db->exec("SELECT * FROM site WHERE revision= '0'");

// /$var_full = $var_full[0];

//var_dump($var_full);

//var_dump($var_full);




//route to main site
$f3->route('GET /',
	function($f3) {
		
		echo \Template::instance()->render('site.htm');
	}
);

//handle routing for audio sharing to facebook
$f3->route('GET /audio/@title/@description/@image/@date/@filename',
	function($f3) {

		//continue from here

		//here's an example array containing some of the fields.

		$content = array('title'=> $f3->get('PARAMS.title'),'description'=> $f3->get('PARAMS.description'));

		$f3->set('content',$content);
		
		echo \Template::instance()->render('share-audio.htm');

		
		
	}
);



//route to CMS
$f3->route('GET /cms',
    function($f3) {
    	$f3->set('content','site.htm');
        

        
        echo \Template::instance()->render('cms.html');
    }
);

$f3->run();
