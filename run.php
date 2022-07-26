<?php

echo <<<EOL
.__        

_________                           __     __      __.__            
/   _____/____  ___.__. ____  __ ___/  |_  /  \    /  \  |__   ____  
\_____  \\__  \<   |  |/  _ \|  |  \   __\ \   \/\/   /  |  \ /  _ \ 
/        \/ __ \\___  (  <_> )  |  /|  |    \        /|   Y  (  <_> )
/_______  (____  / ____|\____/|____/ |__|     \__/\  / |___|  /\____/ 
       \/     \/\/                                \/       \/        

[+] Author: Chael Aracosta
[-] Github: https://github.com/johnmichaelarc

EOL;
PHP_EOL;
echo '[+] Sayout Username (ex:csnntrt): ';
$username = trim(fgets(STDIN, 1024));
echo '[+] Message:';
$message = trim(fgets(STDIN, 1024));
echo '[+] Thread:';
$thread = trim(fgets(STDIN, 1024));

require './config.php';


$sayout = new Sayout($username, $message);
$sayout->start($thread);
