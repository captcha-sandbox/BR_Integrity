<?php
	require('sql_connect.inc');

	$policy = $_POST['policy'];
	$desc = $_POST['description'];
	$id = $_POST['prev_id'];

	$stmt = $conn->prepare("UPDATE policy SET id_policy ='$policy', deskripsi = '$desc' WHERE id_policy = '$id'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil diubah");
					document.location="policy.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>