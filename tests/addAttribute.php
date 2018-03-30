<?php
	require __DIR__ . '/../vendor/autoload.php';
	use HTreeML\Node;

	echo "Not defining the attribute at instantiating and then add it.".PHP_EOL;
	$div=new Node("div");
	$div->addClass("example");
	echo $div->render();
	echo str_repeat(PHP_EOL, 2);

	echo "Defining the attribute at instantiating and then add value to it.".PHP_EOL;
	$div=new Node("div", [
		'class'=>'foo'
	]);
	$div->addClass("bar");
	echo $div->render();