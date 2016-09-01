<?php
	require('sql_connect.inc');

	$id_ref = $_POST['referensi'];
	$predikat = $_POST['predikat'];
	$db_name = $_POST['database'];
	$table_name = $_POST['tabel'];
	$attributes = $_POST['dynamic'];
	$id = $_POST['prev_id'];
	$prev_p = $_POST['prev_p'];

	//get predicate id
	$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$predikat'");
	$stmt->execute();
	$res = $stmt->fetch();
	$id_predikat = $res[0];

	$stmt = $conn->prepare("UPDATE `edb` SET id_predikat = $id_predikat, `reference` = '$id_ref' WHERE id_predikat = $prev_p");
	print_r($stmt);
	$stmt->execute();

	$stmt = $conn->prepare("UPDATE `reference` SET id_ref = '$id_ref', predikat = $id_predikat, table_name = '$table_name', db_name = '$db_name' WHERE id_ref = '$id'");
	print_r($stmt);
	$stmt->execute();
	

	$i=1;
	foreach ($attributes as $attr) {
		$stmt = $conn->prepare("UPDATE ref_attribute SET attr_name = '$attr' WHERE id_ref = '$id_ref' AND `order` = $i");
		print_r($stmt);
		$stmt->execute();
		$i++;
	}
	header("Location: allreference.php");
	// print_r($attributes);

	$conn = null;
?>