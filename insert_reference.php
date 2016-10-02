<?php
	require('sql_connect.inc');

	$id_ref = $_POST['referensi'];
	$predikat = $_POST['predikat'];
	$db_name = $_POST['database'];
	$table_name = $_POST['tabel'];
	$attributes = $_POST['dynamic'];

	//get predicate id
	$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$predikat'");
	$stmt->execute();
	$res = $stmt->fetch();
	$id_predikat = $res[0];

	$stmt = $conn->prepare("INSERT INTO `edb`(id_predikat, `reference`) VALUES ($id_predikat, '$id_ref')");
	print_r($stmt);
	$stmt->execute();

	$stmt = $conn->prepare("INSERT INTO `reference`(id_ref, predikat, table_name, db_name) VALUES ('$id_ref', $id_predikat, '$table_name', '$db_name')");
	print_r($stmt);
	$stmt->execute();
	

	$i=1;
	foreach ($attributes as $attr) {
		$stmt = $conn->prepare("INSERT INTO ref_attribute(id_ref, `order`, attr_name) VALUES ('$id_ref', $i, '$attr')");
		print_r($stmt);
		$stmt->execute();
		$i++;
	}
	header("Location: allreference.php");
	// print_r($attributes);

	$conn = null;
?>