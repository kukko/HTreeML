<?php
	require __DIR__ . '/../vendor/autoload.php';
	use kukko\HTreeML\Node;

	$div=new Node("div");
	$div->insertSpan([
		'class'=>'example'
	])->insertBr([], true);
	echo $div->render();