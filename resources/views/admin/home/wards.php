<?php
header('Access-Control-Allow-Origin: *');
echo json_encode([
	'code' => 200,
	'message' => 'Danh sách xã/phường/thị trấn theo quận/huyện',
	'data' => $ward,
	'meta_data'=> null,
]);
die();
?>
<?php
