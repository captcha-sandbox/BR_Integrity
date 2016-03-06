<?php
	require('sql_connect.inc');

	$source = $_POST['source'];
	$conj = $_POST['conjunction'];
	$ordered = "FALSE";
	if(isset($_POST['ordered'])) {
		$ordered = "TRUE";
	}
	//$ordered = $_POST['ordered'];
	$rulename = $_GET['rule'];

	$stmt = $conn->prepare("INSERT INTO `condition`(source, conj_type, ordered, rule_name) VALUES ('$source', '$conj', $ordered, '$rulename')");
	$stmt->execute();

	if($stmt) {
			?>
				<script language="javascript">
					alert("Data Berhasil Disimpan");
					document.location="index.php";
				</script>
			<?php
			}
		else {
			echo "Sorry, there was an error.";
		}

	$conn = null;
?>