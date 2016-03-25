<?php
	require ('sql_connect.inc');
	$stmt = $conn->prepare("SELECT `name` FROM `table`");
  $stmt->execute();
  $record = array();
  $i = 0;

  while ($result = $stmt->fetch()) {
    $record[$i] = $result['name'];
    $i++;
  }
  $conn = null;

  $idx = $_GET['order'];
  $idx1 = $idx + 2;
  $idx2 = $idx + 3;

	$sub_1 = '<div class="input"><div class="form-group"><label class="control-label col-sm-2" for="source">Source</label><div class="col-sm-10"><select class="form-control" id=source'.$idx1.' name="dynamic[]" onchange="fetch_select(this.value, this.id);">'; 
	
	$sub_2 = '';
	$i = 0;
	while ($i<sizeof($record)) {
		$sub_2 = $sub_2.'<option>'.$record[$i].'</option>';
		$i++;
	}

	$sub_3 = '</select></div><br></div><div class="form-group"><label class="control-label col-sm-2" for="target">Target</label><div class="col-sm-10"><select class="form-control" id=target'.$idx1.' name="dynamic[]"></select></div><br></div><div class="form-group"><label class="control-label col-sm-2" for="conjunction"></label><div class="col-sm-10"><input type="text" name="dynamic[]" class="form-control"/></div><br></div><div class="form-group"><label class="control-label col-sm-2" for="source">Source</label><div class="col-sm-10"><select class="form-control" id=source'.$idx2.' name="dynamic[]" onchange="fetch_select(this.value, this.id);">';

	$sub_4 = '';
	$j = 0;
	while ($j<sizeof($record)) {
		$sub_4 = $sub_4.'<option>'.$record[$j].'</option>';
		$j++;
	}
	
	$sub_5 = '</select></div><br></div><div class="form-group"><label class="control-label col-sm-2" for="target">Target</label><div class="col-sm-10"><select class="form-control" id=target'.$idx2.' name="dynamic[]"></select></div><br></div><div class="form-group"><label class="control-label col-sm-2" for="conjunction"></label><div class="col-sm-10"><select class="form-control" id="conjunction" name="dynamic[]"><option>AND</option><option>OR</option><option></option></select></div><br><hr></div></div>';

	echo $sub_1.$sub_2.$sub_3.$sub_4.$sub_5."\n";
	echo $idx;
?>