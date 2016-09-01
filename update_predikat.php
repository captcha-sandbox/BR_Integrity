<?php
	require('sql_connect.inc');

	$name = $_POST['predikat'];
	$argument = $_POST['argumen'];
	$type = $_POST['tipe'];
	$description = $_POST['description'];
	$id = $_POST['prev_id'];

	$stmt = $conn->prepare("UPDATE `predikat` SET nama_predikat = '$name', jumlah_argumen = $argument, kelompok_predikat = '$type', deskripsi = '$description' WHERE id_predikat = $id");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data Berhasil Disimpan");
					document.location="predikat.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>