<?php

if (isset($_GET['crede'])) {
	$crede = $_GET['crede'];

	require 'navigator.php';
	require 'libuseful.php';

	//has cache
	$folder = "noticias/";
	$filename = "${folder}crede${crede}.json";
	if (file_exists($filename)) {
		$interval = time() - filemtime($filename);
		if ($interval / 3600 > 2) {
			unlink($filename);
			//array_map('unlink', glob($folder . "*.json"));
		} else {
			echo file_get_contents($filename);
			exit();
		}
	}

	$base = "http://www.crede{$crede}.seduc.ce.gov.br";
	initClient(null);
	$crawler = simpleGet('/');

	$noticias = [];
	$crawler->filter('.latestnews li')->each(function ($node) {
		global $base, $noticias;
		$node = $node->filter('span');
		$data = $node->html();
		$data = preg_replace("/\s+/", "", explode("<a", $data)[0]);
		$link = $base . $node->filter('a')->attr('href');
		$text = $node->filter('a')->text();
		$noticia = [];
		$noticia['data'] = $data;
		$noticia['text'] = $text;
		$noticia['link'] = $link;
		array_push($noticias, $noticia);
	});

	$out = ["status" => "ok", "crede" => $crede, "noticias" => $noticias];
	//create cache
	if (!file_exists($folder)) {
		mkdir($folder, 0777);
	}
	$jout = json_encode($out);
	file_put_contents($filename, $jout);
	echo $jout;

} else {
	echo json_encode(["status" => "fail"]);
}
