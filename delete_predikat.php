<?php
	require('sql_connect.inc');

	$id = $_GET['id'];

	$stmt = $conn->prepare("DELETE FROM `predikat` WHERE id_predikat = '$id'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil dihapus");
					document.location="predikat.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>