<?PHP

require_once './Hprose.php';
use Hprose\Client;

$client = Client::create("http://0.0.0.0:8000");
//$client = new \Hprose\Swoole\Client("http://0.0.0.0:8000");
$res  = $client->hello('vvv');
//var_dump($res);
