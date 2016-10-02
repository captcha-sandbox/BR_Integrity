<?php
	require('sql_connect.inc');

	$policy = $_POST['policy'];
	$statement = $_POST['statement'];
	$desc = $_POST['definition'];
	$predikat = $_POST['predicate'];
	$target =  $_POST['target'];
	$type = $_POST['type']; 
	$id = $_POST['prev_id'];

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


	$stmt = $conn->prepare("UPDATE br_statement SET id_statement = '$statement', id_policy ='$policy', definition = '$desc', predikat = $pred, target = $tgt, tipe = '$type' WHERE id_statement = '$id'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil diubah");
					document.location="br_statement.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>