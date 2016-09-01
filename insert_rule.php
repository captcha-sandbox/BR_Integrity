<?php
	require('sql_connect.inc');
	// include "backend/sql_connect.inc";
	include "backend/rule.php";
	include "backend/parser.php";
	include "backend/builder.php";
	include "backend/rule_head.php";
	include "backend/rule_body.php";
	include "backend/rule_manager.php";
	include "backend/expression.php";
	include "backend/querygen.php";

	$rulename = $_POST['source'];
	$desc = $_POST['description'];

	$p = new Parser(); 
	$queries = $p->identifyRule($desc);

	foreach ($queries as $query) {
		echo $query."<br>"; 
		$stmt = $conn->prepare($query);
		$stmt->execute();
	
	/*	if($stmt) {
			?>
				<script language="javascript">
					alert("Data Berhasil Disimpan");
					document.location="rule.php";
				</script>
			<?php
		}
		else {
			echo "Sorry, there was an error.";
		}
	*/
	}
	$conn = null;
?>