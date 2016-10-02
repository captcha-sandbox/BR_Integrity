<?php
	require('sql_connect.inc');

	$statement = $_POST['statement'];
	$policy = $_POST['policy'];
	$definition = $_POST['definition'];
	$predikat = $_POST['predicate'];
	$target = $_POST['target'];
	$type = $_POST['type'];

	$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$predikat'");
	$stmt->execute();
	$res = $stmt->fetch();
	$pred = $res[0];

	$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$target'");
	$stmt->execute();
	$res = $stmt->fetch();
	$tgt = $res[0];

	$stmt = $conn->prepare("SELECT id_predikat FROM predikat WHERE nama_predikat = '$komplemen'");
	$stmt->execute();
	$res = $stmt->fetch();
	$comp = $res[0];

	// if(!empty($comp)) {
	// 	$stmt = $conn->prepare("INSERT INTO `br_statement`(id_statement, id_policy, definition, predikat, target, complement) VALUES ('$statement', '$policy', '$definition', $pred, $tgt, $comp)");
	// 	$stmt->execute();	
	// }
	// else {
	// 	$stmt = $conn->prepare("INSERT INTO `br_statement`(id_statement, id_policy, definition, predikat, target, complement) VALUES ('$statement', '$policy', '$definition', $pred, $tgt, NULL)");
	// 	$stmt->execute();
	// }
	
	$stmt = $conn->prepare("INSERT INTO `br_statement`(id_statement, id_policy, definition, predikat, target, `complement`, tipe) VALUES ('$statement', '$policy', '$definition', $pred, $tgt, NULL, '$type')");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data Berhasil Disimpan");
					document.location="br_statement.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>