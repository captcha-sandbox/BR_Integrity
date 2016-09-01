<?php
	require('sql_connect.inc');

	$id = $_GET['id'];

	$stmt = $conn->prepare("DELETE FROM `reference` WHERE id_ref = '$id'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil dihapus");
					document.location="allreference.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>