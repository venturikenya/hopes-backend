<?php


if(isset($_POST) ){
$html = $_POST['html'];

$css = $_POST['css'];

$css = '<style>'.$css .'</style>';

$data = $html.$css; 


$filename = $_POST['filename'];



$res = file_put_contents($filename, $data);
if($res){

    echo "{'status','success'}";

exit;
}

echo "{'status','file I/O error'}";
exit;




}

echo "{'status','error'}";

exit;
