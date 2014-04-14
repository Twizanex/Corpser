<?php
/**
 * Save draft through ajax
 *
 * @package story
 */
?>
elgg.provide('elgg.story');

/*
 * Attempt to save and update the input with the guid.
 */
elgg.story.saveDraftCallback = function(data, textStatus, XHR) {
	if (textStatus == 'success' && data.success == true) {
		var form = $('form[id=story-post-edit]');

		// update the guid input element for new posts that now have a guid
		form.find('input[name=guid]').val(data.guid);

		oldDescription = form.find('textarea[name=description]').val();

		var d = new Date();
		var mins = d.getMinutes() + '';
		if (mins.length == 1) {
			mins = '0' + mins;
		}
		$(".story-save-status-time").html(d.toLocaleDateString() + " @ " + d.getHours() + ":" + mins);
	} else {
		$(".story-save-status-time").html(elgg.echo('error'));
	}
};

elgg.story.saveDraft = function() {
	if (typeof(tinyMCE) != 'undefined') {
		tinyMCE.triggerSave();
	}

	// only save on changed content
	var form = $('form[id=story-post-edit]');
	var description = form.find('textarea[name=description]').val();
	var title = form.find('input[name=title]').val();

	if (!(description && title) || (description == oldDescription)) {
		return false;
	}

	var draftURL = elgg.config.wwwroot + "action/story/auto_save_revision";
	var postData = form.serializeArray();

	// force draft status
	$(postData).each(function(i, e) {
		if (e.name == 'status') {
			e.value = 'draft';
		}
	});

	$.post(draftURL, postData, elgg.story.saveDraftCallback, 'json');
};

elgg.story.init = function() {
	// get a copy of the body to compare for auto save
	oldDescription = $('form[id=story-post-edit]').find('textarea[name=description]').val();
	
	setInterval(elgg.story.saveDraft, 60000);
};

elgg.register_hook_handler('init', 'system', elgg.story.init);