elgg.provide('elgg.extended_tinymce');

/**
 * Toggles the extended tinymce editor
 *
 * @param {Object} event
 * @return void
 */
elgg.extended_tinymce.toggleEditor = function(event) {
    event.preventDefault();

    var target = $(this).attr('href');
    var id = $(target).attr('id');
    var $link = $(this);

    tinyMCE.execCommand('mceToggleEditor', false, id);
    if ($link.html() == elgg.echo('extended_tinymce:remove')) {
        $link.html(elgg.echo('extended_tinymce:add'));
    } else {
        $link.html(elgg.echo('extended_tinymce:remove'));
    }
}

/**
 * TinyMCE initialization script
 *
 * You can find configuration information here:
 * http://tinymce.moxiecode.com/wiki.php/Configuration
 */
elgg.extended_tinymce.init = function() {

    $('.extended_tinymce-toggle-editor').live('click', elgg.extended_tinymce.toggleEditor);

    $('.elgg-input-longtext').parents('form').submit(function() {
        tinyMCE.triggerSave();
    });

    tinyMCE.init({
        selector: ".elgg-input-longtext",
        theme: "modern",
		theme_advanced_path : false,
        skin : "custom4",
        language : "<?php echo extended_tinymce_get_site_language(); ?>",
        relative_urls : false,
		fontsize_formats: "10pt",
        remove_script_host : false,
        document_base_url : elgg.config.wwwroot,
        plugins: "localautosave autoresize fullscreen advlist autolink charmap code emoticons hr image insertdatetime link lists paste preview searchreplace table textcolor wordcount",
        menubar: false,
        toolbar_items_size: "small",
        toolbar1: "fullscreen | newdocument | localautosave preview | searchreplace | cut copy paste | undo redo | italic underline | aligncenter alignright alignjustify | charmap",
        width : "100%",
		browser_spellcheck : true,
		contextmenu: false,
		paste_as_text: true,
		las_keyName: "LocalAutoSave",
		las_nVersions: 1,
		las_seconds: 5,
		las_callback: function() { 
					var cont = $( ".elgg-heading-main" ).text();
					var parentid = $( "input[name='parent_guid']" ).val();
					var title = $( "input[name='title']" ).val();
					elgg.action('pages/savedraft', {
						data: {
							draftdata: this.content,
							context: cont,
							title: title,
							parent_guid: parentid
						},
						success: function(json) {
							// por ahora nada
						}
					});
		},
        browser_spellcheck : true,
        image_advtab: true,
        paste_data_images: false,
        insertdate_formats: ["%I:%M:%S %p", "%H:%M:%S", "%Y-%m-%d", "%d.%m.%Y"],
		setup : function(ed)
		{
			ed.on('init', function() 
			{
				ed.pasteAsPlainText = true;
				this.getDoc().body.style.fontSize = '14px';
				this.getDoc().body.style.color = '#333333';
				this.getDoc().body.style.textAlign = 'justify';
			});
		},
        content_css: elgg.config.wwwroot + 'mod/extended_tinymce/css/elgg_extended_tinymce.css'
    });
	
}

elgg.register_hook_handler('init', 'system', elgg.extended_tinymce.init);
