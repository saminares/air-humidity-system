<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
include('Net/SSH2.php');
$ssh = new Net_SSH2('192.168.11.5');
if (!$ssh->login('root', 'p9z34c')) {
    exit('Login Failed');
}
$ssh->write("echo 0 > /sys/class/leds/tp-link:blue:relay/brightness\n"); // turns Kankun relay off
$output = $ssh->read('username@username:~$');
  
?>