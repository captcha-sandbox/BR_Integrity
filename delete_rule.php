<?php
	require('sql_connect.inc');

	$rule = $_GET['id'];

	$stmt = $conn->prepare("DELETE FROM `idb` WHERE id_aturan = '$rule'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil dihapus");
					document.location="rule.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>