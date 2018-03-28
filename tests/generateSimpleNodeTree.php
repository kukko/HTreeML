<?php
	require __DIR__ . '/../vendor/autoload.php';
	use HTreeML\Node;

	$div=new Node("div", [
		'style'=>'color:#0000FF;'
	]);
	$p=new Node("p");
	$span=new Node("span");
	$span->addString("ASD");
	$p->addElement($span);
	$p->addString("DSA");
	$div->addElement($p);
	echo $div->render();