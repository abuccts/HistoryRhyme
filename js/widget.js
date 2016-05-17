var commonUrls =
{
	imgRootUrl: 'http://222.29.193.172:8006/lmHistoryTMMSuppData/demo/imgs/'
};


var tagColors = ['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown'];

/*
function mkform(rootEle, d, fields, processFunc) {
	$.each(fields, function(i, field) {
		$fieldDiv = $('<div class="field"></div>');
		$fieldDiv.append('<label>' + field + '</label>');
		if (i < 4) {
			if (i < 3) {
				$fieldInput = $('<div id="' + field + 'Input" name="' + field + '" class="ui fluid selection dropdown"></div>');
			} else {
				$fieldInput = $('<div id="' + field + 'Input" name="' + field + '" class="ui fluid search selection dropdown"></div>');
			}
			$fieldInput.append('<input type="hidden" name="' + field + '"><i class="dropdown icon"></i>' + 
								'<div class="default text">' + field + '</div>');
			$menu = $('<div class="menu"></div>');
			$.each(d[field], function(j, item) {
				$menu.append('<div class="item" data-value="' + item[0] + '">' + item[1] + '</div>');
			});
			$fieldInput.append($menu);
		} else {
			$fieldInput = $('<input id="' + field + 'Input" name="' + field + '" type="text" placeholder="' + field + '">');
		}
		$fieldDiv.append($fieldInput);
		rootEle.append($fieldDiv);
	});
	$('.ui.dropdown').dropdown();
	processFunc();
}
*/

function mkform(rootEle, d, processFunc) {
	rootEle.html('<div class="two wide field"></div>' + 
				'<label>With</label>' +
				'<div class="five wide field">' +
					'<div id="classInput" class="ui search">' +
						'<input class="prompt" type="text" name="class" placeholder="object/scene">' +
						'<div class="results"></div>' +
					'</div>' +
					'<label>object/scene</label>' +
				'</div>' +
				'<label>by</label>' +
				'<div class="four wide field">' +
					'<div id="personInput" class="ui search selection dropdown">' +
						'<input type="hidden" name="person">' +
						'<i class="dropdown icon"></i>' +
						'<div class="default text">person</div>' +
						'<div class="menu"></div>' +
					'</div>' +
					'<label>person</label>' +
				'</div>' +
				'<label>during</label>' +
				'<div class="three wide field">' +
					'<div id="periodInput" class="ui selection dropdown">' +
						'<input type="hidden" name="period">' +
						'<i class="dropdown icon"></i>' +
						'<div class="default text">period</div>' +
						'<div class="menu"></div>' +
					'</div>' +
					'<label>period.</label>' +
				'</div>' +
				'<div class="two wide field"></div>');
	$.each(d['person'], function(i, item) {
		$('#personInput .menu').append('<div class="item" data-value="' + item[0] + '">' + item[1] + '</div>');
	});
	$.each(d['period'], function(i, item) {
		$('#periodInput .menu').append('<div class="item" data-value="' + item[0] + '">' + item[1] + '</div>');
	});
	$('.ui.search').search({ source: d['class'] });
	$('.ui.dropdown').dropdown();
	processFunc();
}


function mktable(rootEle, d, clickFunc) {
	$.each(d, function(i, field) {
		$trow = $('<tr></tr>');
		$.each(field, function(j, item) {
			$trow.append('<td>' + item[1] + '</td>');
		});
		$trow.click(function() {
			clickFunc(field);
		});
		rootEle.append($trow);
	});
}


function mklist(rootEle, d, param) {
	rootEle.html('');
	startPos = param[0] * param[1];
	endPos = (param[0] + 1) * param[1];
	$.each(d.slice(startPos, endPos), function(i, eventItem) {
		$itemDiv = $('<div class="item list-group-item"></div>');
		$tags = $('<div class="right floated content"></div>');
		$.each(eventItem['tag'].slice(0, 5), function(j, tagItem) {
			var color = tagColors[tagItem.length % tagColors.length];
			$tags.append('<div class="ui ' + color + ' label">' + tagItem + '</div>');
		});
		$itemDiv.append($tags);
		$itemDiv.append('<a href="event.html?eid=' + eventItem['eid'] + '" class="list-link" target="_blank">&nbsp;</a>' +
						'<div class="content event-content">' + eventItem['text'] + '</div>');
		rootEle.append($itemDiv);
	});
}


function mktags(rootEle, d, processFunc) {
	rootEle[0].html('');
	rootEle[1].text(d['text']);
	$.each(d['tag'], function(i, t) {
		$eachTag = $('<button class="ui inverted button">' + t + '</button>');
		$eachTag.addClass(tagColors[t.length % tagColors.length]);
		rootEle[0].append($eachTag);
	});
	processFunc();
}


function Slide(rootEle, d, itemDisplayNum, processFunc) {
	rootId = rootEle.attr('id');
	rootEle.append('<ul id="slide"></ul>');
	$.each(d, function(i, field) {
		rootEle.children('ul').append(processFunc(field));
	});
	var autoplaySlider = $('#slide').lightSlider({
		item: itemDisplayNum,
		easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
		auto: true,
		loop: true,
		pauseOnHover: true,
		responsive: [{
			breakpoint: 800,
			settings: {
				item: 3,
				slideMove: 1,
				slideMargin: 6
			}
		},
		{
			breakpoint:480,
			settings: {
				item: 2,
				slideMove: 1
			}
		}]
	});
}


function ExtendedCarousel(rootEle, d, cols, param) {
	$.each(d, function(i, field) {
		var lightSliderId = 'lightSlider' + param + i;
		rootEle.append('<div class="cascade-item"><h3 align="center"></h3><ul id=' + lightSliderId + '></ul></div>');
		$.each(field, function(j, img) {
			if ( !j && img.indexOf('jpg') == -1 ) {
				$('#' + lightSliderId).prev().html('<a class="ui ' + tagColors[img.length % tagColors.length] +
													' large label">' + img + '</a>');
			} else {
				$('#' + lightSliderId).append('<li data-thumb="' + commonUrls.imgRootUrl + img +
											'"><img src="' + commonUrls.imgRootUrl + img + '"></li>');
			}
		});
	});

	rootEle.imagesLoaded(function() {
		$.each(d, function(i, field) {
			$('#lightSlider' + param + i).lightSlider({
				gallery: true,
				item: 1,
				loop: true,
				slideMargin: 0,
				thumbItem: 3
			});
		});
		rootEle.masonry({
			itemSelector: '.cascade-item',
			columnWidth: function(containerWidth) {
				return containerWidth / cols;
			}
		});
        
		$('.facet-info').resize();
	});
}


