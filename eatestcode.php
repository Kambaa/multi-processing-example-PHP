<?php
$bankClasses = [
'Akbank' => "AkbankExtreService::class",
'Ziraat' => "ZiraatExtreService::class",
'TEB' => "TEBExtreService::class"
];


if (function_exists('pcntl_fork')) {
	foreach ($bankClasses as $k=>$v) {
		$pid = pcntl_fork();
		if ($pid == -1) {
			die('could not fork');
		} else if ($pid) {
			continue;
	     // we are the parent
		} else {
			sleep(5);
			echo $bankClasses[$k] . " is forked with pid: " . $pid.PHP_EOL;
			exit();
		}
	}
 	//pcntl_wait($status); //Protect against Zombie children
 	while (pcntl_waitpid(0, $status) != -1) {
 		$status = pcntl_wexitstatus($status);
 		echo "Child $status completed\n";
 	}
 }