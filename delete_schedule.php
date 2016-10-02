<?php
	require('sql_connect.inc');
	include "backend/cronmanager.php";
	include "backend/scheduler.php";

	$id = $_GET['id'];

	$stmt = $conn->prepare("SELECT instruksi FROM `schedule` WHERE id_jadwal = '$id'");
	$stmt->execute();

	$res = $stmt->fetch();
	$desc = $res[0];

	# prepare regex for removing job
	$pre = substr($desc, 1);
	$pre = str_replace("/", "\/", $pre);
	$job = "/".$pre."/"; echo $job;

	$schedule = new Scheduler();
	$schedule->deleteSchedule($job);
	
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