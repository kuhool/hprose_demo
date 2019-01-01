<?PHP

//const SWOOLE_BASE = 2;
require_once './Hprose.php';

use Hprose\Swoole\Http\Server;

function hello($name) {
    var_dump($name);
    return "Hello $name!";
}



$server = new Server("http://0.0.0.0:8000");
$server->add("hello");
$server->debug = true;
$server->crossDomain = true;
$server->start();
