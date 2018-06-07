<?php

require_once '../vendor/autoload.php';
use Goutte\Client;

$hasProxy = false;
$proxySet = [
	'proxy' => [
		'http' => 'aluno:aluno@20.20.0.1:8080',
	],
];
$base = 'http://www.crede17.seduc.ce.gov.br';

$client = null;
function initClient($cookies = null) {
	global $client, $hasProxy, $proxySet;
	if (is_null($cookies)) {
		$client = new Client();
	} else {
		$client = new Client(array(), null, $cookies);
	}
	$client->setHeader('User-Agent', "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0");
	if ($hasProxy) {
		$client->setClient(new \GuzzleHttp\Client($proxySet));
	}
}

function simpleGet($path) {
	global $client;
	global $base;
	return $client->request(
		'GET',
		$base . $path
	);
}

function get($path, $params) {
	global $client;
	global $base;
	return $client->request(
		'GET',
		$base . $path . "?" . http_build_query($params)
	);
}

// function post($path, $params){
//     global $client, $base;
//     return $client->request(
//         'POST',
//         "$base/$path",
//         $params
//     );
// }
