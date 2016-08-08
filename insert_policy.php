<?php
	require('sql_connect.inc');

	$policy = $_POST['policy'];
	$description = $_POST['description'];

	$stmt = $conn->prepare("INSERT INTO `policy`(id_policy, deskripsi) VALUES ('$policy', '$description')");
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