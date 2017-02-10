<?php
	require '../vendor/autoload.php';

	use Elasticsearch\ClientBuilder;

	$hosts = [
    	'10.254.21.57:9200', 
	];
	$client = ClientBuilder::create()->setHosts($hosts)->build();

	$conn = mysqli_connect("localhost", "root", "root", "yg");
	$sql = "SELECT * FROM `users`";
	$result = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_assoc($result)) {
		unset($row['name']);
		unset($row['position']);
	    $params = [
		    'index' => 'yg',
		    'type' => 'users',
		    'id' => $row['user_id'],
		    'body' => $row
		];
		//写数据
		$response = $client->index($params);
	}
	mysqli_free_result($result);
	

	//读数据
    $params = [
	    'index' => 'yg',
	    'type' => 'users',
	    'body'=>[
	    	'query'=>[
	    		'bool'=>[
	    			'should'=>[
		    			'wildcard' => [
		    				'username'=>'*ang*'
		    			]
		    		]
	    		]
	    	]
	    ]
	];
	$response = $client->search($params);
	print_r($response);