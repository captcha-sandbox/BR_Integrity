<?php
	include "sql_connect.inc";
	include "backend/cronmanager.php";
	include "backend/scheduler.php";

	$br = $_POST['statement'];
	$minute = $_POST['minute'];
	$hour = $_POST['hour'];
	$date = $_POST['day'];
	$month = $_POST['month'];
	$day = $_POST['weekday'];
	$command = $_POST['instruction'];
	$desc = $_POST['keterangan'];

	$time = $minute." ".$hour." ".$date." ".$month." ".$day; 

	#get business rule predicate
	$stmt = $conn->prepare("SELECT nama_predikat FROM br_statement br INNER JOIN predikat p ON br.predikat = p.id_predikat WHERE br.id_statement = '$br'");
	$stmt->execute();
	$res = $stmt->fetch();
	$predicate = $res[0];

	#register cron job to server
	$schedule = new Scheduler();
	$param = $schedule->createSchedule($br, $predicate, $time);

	// #save setting into database
	$stmt = $conn->prepare("INSERT INTO `schedule`(jadwal, instruksi, keterangan, `statement`) VALUES ('$time', '$param', '$desc', '$br')");
	// var_dump($stmt);
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