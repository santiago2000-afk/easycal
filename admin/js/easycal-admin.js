(function($) {
	'use strict';
	$(document).ready(function() {
		adminCore.init();
	});
	var adminCore = {
		init: function() {
			var inputs = $('.copy-to-clipboard');
			inputs.each(function(index, element){
				var input = $(element);
				input.on('click', function(){
					$(this).select();
					adminCore.copyToClipboard($(this));
					var labelInfo = input.siblings('.label-info');
					if(labelInfo.length >= 1){
						labelInfo.remove();
					}else {
						adminCore.labelInfo('copied', $(this));
					}
				});
			});
		},
		showMessageError: function(message){
			alert(message);
		},
		copyToClipboard: function(element) {
			var copyElement = $(element);
			try {
				navigator.clipboard.writeText(copyElement.val());
			}catch (err) {
				adminCore.showMessageError("Error" + err);
			}
		},
		labelInfo: function(info, element){
			var label = $('<label>');
			label.text(info);
			label.attr('for', element.attr('id'));
			label.attr('class', 'label-info');
			element.after(label);
		},
	}
})( jQuery );
