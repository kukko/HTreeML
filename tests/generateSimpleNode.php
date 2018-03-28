<?php
	require __DIR__ . '/../vendor/autoload.php';
	use HTreeML\Node;

	$div=new Node("div");
	echo $div->render();