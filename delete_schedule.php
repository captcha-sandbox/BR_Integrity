<?php
	require('sql_connect.inc');

	$id = $_GET['id'];

	$stmt = $conn->prepare("DELETE FROM `schedule` WHERE id_jadwal = '$id'");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data berhasil dihapus");
					document.location="schedule.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>