<?PHP

require_once './Hprose.php';
use Hprose\Client;

$client = Client::create("http://0.0.0.0:8000",true);//普通异步客户端
//$client = \Hprose\Swoole\Client::create('http://0.0.0.0:8000');//swoole异步客户端
//var_dump($client);exit;
$res  = $client->hello('vvv');
//var_dump($client);
