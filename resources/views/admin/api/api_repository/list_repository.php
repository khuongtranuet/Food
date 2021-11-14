<?php
//echo_pre($result_repository);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
echo json_encode([
	'code' => 200,
	'message' => 'Danh sách kho hàng',
	'data' => $result_repository,
	'meta_data'=> [
		'page' => (int)$page,
		'page_size' => (int)$page_size,
		'total_rows' => $total_rows,
	],
]);
//echo json_encode($result_repository);
die();
?>
