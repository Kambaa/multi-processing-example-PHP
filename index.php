<?php
/**
 * Created by PhpStorm.
 * User: yg
 * Date: 1/16/17
 * Time: 11:19 AM
 */

if (! function_exists('pcntl_fork')) die('PCNTL functions not available on this PHP installation');


for ($i = 1; $i <= 1005; ++$i) {
    $pid = pcntl_fork();

    if (!$pid) {
        sleep(1);
        print "In child $i\n";
        exit($i);
    }
}

while (pcntl_waitpid(0, $status) != -1) {
    $status = pcntl_wexitstatus($status);
    echo "Child $status completed\n";
}