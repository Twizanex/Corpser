//<script>

	elgg.provide('elgg.theme');

	elgg.theme.init = function() {
		//$.migrateMute = true;
		$(document).foundation();

		// Make More menu item respond to clicks
		$('.elgg-menu-site li.elgg-more')
				.live('mouseover', function() {
			$(this).addClass('elgg-state-active')
		})
				.live('mouseout', function() {
			$(this).removeClass('elgg-state-active')
		})
				.live('click', function() {
			if ($(this).hasClass('elgg-state-active')) {
				$(this).removeClass('elgg-state-active')
			} else {
				$(this).addClass('elgg-state-active')
			}
		});
	}

	elgg.register_hook_handler('init', 'system', elgg.theme.init);

	/**
	 * @hack Fixing avatar cropper by supplying 'parent' parameter
	 */
	elgg.provide('elgg.avatarCropper');

	// Need to change the parent element, otherwise the offset calculation is wrong
	elgg.avatarCropper.init = function() {
		if (!$.isFunction($.fn.imgAreaSelect)) {
			return;
		}
		var params = {
			selectionOpacity: 0,
			aspectRatio: '1:1',
			onSelectEnd: elgg.avatarCropper.selectChange,
			onSelectChange: elgg.avatarCropper.preview,
			parent: 'form.elgg-form-avatar-crop'
		};

		if ($('input[name=x2]').val()) {
			params.x1 = $('input[name=x1]').val();
			params.x2 = $('input[name=x2]').val();
			params.y1 = $('input[name=y1]').val();
			params.y2 = $('input[name=y2]').val();
		}

		$('#user-avatar-cropper').imgAreaSelect(params);

		if ($('input[name=x2]').val()) {
			var ias = $('#user-avatar-cropper').imgAreaSelect({instance: true});
			var selection = ias.getSelection();
			elgg.avatarCropper.preview($('#user-avatar-cropper'), selection);
		}
	};

	elgg.register_hook_handler('init', 'system', elgg.avatarCropper.init);
