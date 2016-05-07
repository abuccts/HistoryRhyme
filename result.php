<?php

	$type = 1;

	$querystr = "";

	if (isset($_GET["object"])){
		$object = $_GET["object"];
		$scene  = $_GET["scene"];
		$period = $_GET["period"];
		$person = $_GET["person"];
		$verb   = $_GET["verb"];

		$querystr = 'object='.$object.'&scene='.$scene.'&period='.$period.'&person='.$person.'&verb='.$verb;
	}else{

		$type = 2;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<!-- Site Properties -->
	<title>Demo</title>
	
	<link rel="stylesheet" type="text/css" href="css/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="css/banner.css">
	<link rel="stylesheet" type="text/css" href="css/result.css">
</head>

<body>
	<div id="banner" class="ui basic left aligned inverted segment">
		<h1 class="ui header">Demo Design</h1>
	</div>
	
	<div class="ui one column doubling stackable centered grid container">
	
		<div class="column">
			<h2 class="ui dividing header">Results about</h2>
			<div class="ui form">
				<div id="resultForm" class="five fields"></div>
			</div>
		</div>
		
		<div class="column">
			<div class="ui piled segment">
				<div id="resultList" class="ui divided list list-group"></div>
			</div>
		</div>
		
		<div class="center aligned column">
			<button id="prevBtn" class="ui left labeled icon button">
				<i class="left arrow icon"></i> Prev
			</button>
			<button id="nextBtn" class="ui right labeled icon button">
				<i class="right arrow icon"></i> Next
			</button>
		</div>

	</div>

	<!-- javascript -->

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/semantic.min.js"></script>
	<script type="text/javascript" src="js/parseUri.js"></script>
	<script type="text/javascript" src="js/widget.js"></script>
	<script type="text/javascript">
		var querylistJsonUrl = 'json/querylist.json';
		var resultJsonUrl = 'json/result.json';
		
		var querylistData = undefined;
		var resultData = "";
		
		var fields = ['object', 'scene', 'period', 'person', 'verb'];
		var pageItemNum = 4;

		function getResult(str) {
			resultData = str;
		}
		
		$(document).ready(function() {
			var url = window.location.href;

			var query = fields.map(function(field) {
				return parseUri(url).queryKey[field];
			});
			
			$.getJSON(querylistJsonUrl, function(d) {
				querylistData = d;
				var resultForm = new mkform($('#resultForm'), d, fields, function() {
					$.each(fields, function(id, field) {
						if (id < 4) {
							$('#' + fields[id] + 'Input').dropdown('set selected', query[id]);
							$('#' + fields[id] + 'Input').closest('div').addClass('disabled');
						} else {
							$('#resultForm').form('set value', 'verb', query[id]);
							$('#' + fields[id] + 'Input').attr('disabled', true);
						}
					});
				});
			});

			var pageNum = 0;
			var totalPage = 0;

			if (resultData.length % pageItemNum == 0) {
				totalPage = parseInt(resultData.length / pageItemNum);
			} else {
				totalPage = parseInt(resultData.length / pageItemNum) + 1;
			}
			var resultList = new mklist($('#resultList'), resultData, [pageNum, pageItemNum]);

			$('#prevBtn').click(function() {
				if (pageNum > 0) {
					pageNum --;
					resultList = mklist($('#resultList'), resultData, [pageNum, pageItemNum]);
				}
			});
			$('#nextBtn').click(function() {
				if (pageNum < totalPage - 1) {
					pageNum ++;
					resultList = mklist($('#resultList'), resultData, [pageNum, pageItemNum]);
				}
			});

		});	
	
	</script>


	<?php
	echo '<script type="text/javascript" src="json.php?'.$querystr.'"></script>';
	?>
</body>
</html>