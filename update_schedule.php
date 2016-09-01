<?php
	require('sql_connect.inc');

	$br = $_POST['statement'];
	$minute = $_POST['minute'];
	$hour = $_POST['hour'];
	$date = $_POST['day'];
	$month = $_POST['month'];
	$day = $_POST['weekday'];
	$command = $_POST['instruction'];
	$desc = $_POST['keterangan'];
	$id = $_POST['prev_id'];

	$time = $minute." ".$hour." ".$date." ".$month." ".$day;

	$stmt = $conn->prepare("UPDATE `schedule` SET id_statement = '$br', jadwal = '$time', instruksi = '$command', keterangan = '$desc' WHERE id_jadwal = $id");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data Berhasil Disimpan");
					document.location="schedule.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>