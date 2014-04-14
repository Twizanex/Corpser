<?php

	$english = array(
		// general
		'pages_tools:allow_comments' => "Allow comments",
		'pages_tools:unpublished' => "Unpublished",
		
		'pages_tools:number' => "Number",
		'pages_tools:story_type' => "Story Type",
		
		'pages_tools:content' => 'Text',
		'pages_tools:intro' => 'Epigraph/Introduction',
		
		'pages_tools:normal' => 'Normal Story',
		'pages_tools:gamebook' => 'Gamebook Story',
		'pages_tools:exquisitecorpse' => 'Exquisite Corpse Story',
		
		'pages_tools:shortnormal' => "Story",
	    'pages_tools:exquisitecorpse' => "Exquisite Corpse",
	    'pages_tools:gamebook' => "Gamebook",
		'pages_tools:unknown' => "An unknown type story",
		
		'pages_tools:continuegamestory' => "Continue this Gamestory",
		'pages_tools:continuestory' => "Continue this Story",
		'pages_tools:continuecorpse' => "Continue this Exquisite Corpse Story",
		'pages_tools:ownward' => "Onward →",
		'pages_tools:goback' => "← Go back",
		
		
		'pages_tools:corpses_number' => "Number of Corpses",
		'pages_tools:corpses_word_number' => "Min Words per Corpse",
		'pages_tools:corpses_word_number_max' => "Max Words per Corpse",
		
		'pages_tools:corpse_word_number_placeholder' => "Enter the minimum number of word you want to have in every Corpse. Explore different Corpse sizes, will be fun ;)",
		'pages_tools:corpse_word_number_max_placeholder' => "Establish a limit of words.",
		'pages_tools:corpses_number_placeholder' => "Establish the number of Corpses the story will have. If you left blank, you could choose when to end it",
		
		// notification
		'pages_tools:notify:edit:subject' => "Your page '%s' was edited",
		'pages_tools:notify:edit:message' => "Hi,
		
Your page '%s' was edited by %s. Check out the new version here:
%s",
	
		'pages_tools:notify:publish:subject' => "A page has been published",
		'pages_tools:notify:publish:message' => "Hi,
		
your page '%s' has been published.

You can view your page here:
%s",
		
		'pages_tools:notify:expire:subject' => "A page has expired",
		'pages_tools:notify:expire:message' => "Hi,
		
your page '%s' has expired.

You can view your page here:
%s",
		
		// export page
		'page_tools:export:format' => "Page format",
		'page_tools:export:format:a4' => "A4",
		'page_tools:export:format:letter' => "Letter",
		'page_tools:export:format:a3' => "A3",
		'page_tools:export:format:a5' => "A5",
		
		'page_tools:export:include_subpages' => "Include subpages",
		'page_tools:export:include_index' => "Include index",
		
		'pages_tools:navigation:tooltip' => "Did you know you can drag-and-drop pages to reorder the navigation tree?",
		
		// widget
		'pages_tools:widgets:index_pages:description' => "Show the latest pages on your community",
		
		// settings
		'pages_tools:settings:advanced_publication' => "Allow advanced publication options",
		'pages_tools:settings:advanced_publication:description' => "With this users can select a publication and expiration date for pages. Requires a working daily CRON.",
		
		// edit
		'pages_tools:label:publication_options' => "Publication options",
		'pages_tools:label:publication_date' => "Publication date (optional)",
		'pages_tools:publication_date:description' => "When you select a date here the page will not be published until the selected date.",
		'pages_tools:label:expiration_date' => "Expiration date (optional)",
		'pages_tools:expiration_date:description' => "The page will no longer be published after the selected date.",
		
		// actions
		// export
		'pages_tools:export:index' => "Contents",
		
		// reorder pages
		'pages_tools:actions:reorder:error:subpages' => "No pages to reorder were supplied",
		'pages_tools:actions:reorder:success' => "Successfully reordered the pages",
		'' => "",
		
		'pages_tools:participation_requests_none' => "There are no current participation requests.",
		'pages_tools:invitations_does_not_allowed_requests' => "This story does not allow participation requests.",
		
	
	);
	
	add_translation("en", $english);