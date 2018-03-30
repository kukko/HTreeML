<?php
	require __DIR__ . '/../vendor/autoload.php';
	use HTreeML\Node;

	$div=new Node("div");
	$div->style="color:#0000FF;";
	$span=new Node("span");
	$div->addElement($span);
	$span->style="font-size:10px;";

	echo $div->render();