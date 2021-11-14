<?php
header('Access-Control-Allow-Origin: *');
echo json_encode([
	'code' => 200,
	'message' => 'Danh sách quận/huyện theo tỉnh thành',
	'data' => $district,
	'meta_data'=> null,
]);
die();
?>
