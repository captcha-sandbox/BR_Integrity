<?php
	require('sql_connect.inc');

	$policy = $_GET['id'];

	$stmt = $conn->prepare("DELETE FROM `policy` WHERE id_policy = '$policy'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil dihapus");
					document.location="policy.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>