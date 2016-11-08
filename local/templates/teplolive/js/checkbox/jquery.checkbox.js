/*
 * jQuery Checkbox Styler 1.1.2
 * http://dimox.name/styling-input-checkboxes-using-jquery-css/
 *
 * Copyright 2012 Dimox (http://dimox.name/)
 * Released under the MIT license.
 *
 * Date: 2012.10.07
 *
 */

(function($) {
	$.fn.checkbox = function() {
		$(this).css({position: 'absolute', left: '-9999px'}).each(function() {
			var input = $(this);
			if (input.next('span.checkbox').length < 1) {
				var span = $('<span class="checkbox" style="display:inline-block"></span>');
				input.after(span);
				if (input.is(':checked')) span.addClass('checked');
				if (input.is(':disabled')) span.addClass('disabled');
				// клик на псевдочекбокс
				span.click(function() {
					if (!span.is('.disabled')) {
						if (input.is(':checked')) {
							input.removeAttr('checked');
							span.removeClass('checked');
						} else {
							input.attr('checked', true);
							span.addClass('checked');
						}
						input.change();
						return false;
					}
				});
				// клик на label
				input.parent('label').add('label[for="' + input.attr('id') + '"]').click(function() {
					span.click();
					return false;
				});
				// переключение по Space или Enter
				input.change(function() {
					if (input.is(':checked')) span.addClass('checked');
					else span.removeClass('checked');
				})
				// чтобы переключался чекбокс, который находится в теге label
				.keydown(function(e) {
					if (input.parent('label').length && (e.which == 13 || e.which == 32)) span.click();
				})
				.focus(function() {
					if (!span.is('.disabled')) span.addClass('focused');
				})
				.blur(function() {
					span.removeClass('focused');
				});
				// обновление при динамическом изменении
				input.live('refresh', function() {
					if (input.is(':checked')) span.addClass('checked');
						else span.removeClass('checked');
					if (input.is(':disabled')) span.addClass('disabled');
						else span.removeClass('disabled');
				})
			}
		});
	}
})(jQuery)