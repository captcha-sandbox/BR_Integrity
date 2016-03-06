<?php
	require('sql_connect.inc');

	$rulename = $_POST['rule_name'];
	$source = $_POST['source'];
	$target = $_POST['target'];
	$desc = $_POST['description'];

	$stmt = $conn->prepare("INSERT INTO business_rule(rule_name, target, source, description) VALUES ('$rulename', '$target', '$source', '$desc')");
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