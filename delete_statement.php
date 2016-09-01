<?php
	require('sql_connect.inc');

	$id = $_GET['id'];

	$stmt = $conn->prepare("DELETE FROM `br_statement` WHERE id_statement = '$id'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil dihapus");
					document.location="br_statement.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>