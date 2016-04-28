var commonUrls =
{
	imgRootUrl: 'http://222.29.193.172:8006/lmHistoryTMMSuppData/demo/imgs/'
};


function form(rootEle, d) {
	var fields = ['object', 'scene', 'period', 'person', 'verb'];
	$.each(fields, function(i, field) {
		$fieldDiv = $('<div class="field"></div>');
		$fieldDiv.append('<label>' + field + '</label>');
		if (i < 3) {
			$fieldInput = s;
		} else if (i == 3) {
			;
		} else {
			;
		}
	});
}

function table(rootEle, d, clickFunc) {
	$.each(d, function(i, field) {
		$trow = $('<tr></tr>');
		$.each(field, function(j, item) {
			$trow.append('<td>' + item + '</td>');
		});
		$trow.click(function() {
			clickFunc(field);
		});
		rootEle.append($trow);
	});
}

