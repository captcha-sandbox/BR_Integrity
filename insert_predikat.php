<?php
	require('sql_connect.inc');

	$name = $_POST['predikat'];
	$argument = $_POST['argumen'];
	$type = $_POST['tipe'];
	$description = $_POST['description'];

	$stmt = $conn->prepare("INSERT INTO `predikat`(nama_predikat, jumlah_argumen, kelompok_predikat, deskripsi) VALUES ('$name', $argument, '$type', '$description')");
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