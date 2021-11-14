<?php
header('Access-Control-Allow-Origin: *');
echo json_encode([
	'code' => 200,
	'message' => 'Danh sách tỉnh thành',
	'data' => $province,
	'meta_data'=> null,
]);
die();
?>
