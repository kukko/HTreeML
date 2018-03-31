<?php
	require __DIR__ . '/../vendor/autoload.php';
	use kukko\HTreeML\Node;

	$div=new Node("div");
	$div->addClass('foo')
		->addClass('bar');
	echo $div->render();