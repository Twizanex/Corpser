<?php
/**
 * Page edit form body
 *
 * @package ElggPages
 */

$variables = elgg_get_config('pages');
$user = elgg_get_logged_in_user_entity();
$entity = elgg_extract('entity', $vars);
$pageEdit = get_entity(elgg_extract("guid", $vars));
$parent_guid = elgg_extract("parent_guid", $vars);
$containers = elgg_view('input/containers', $vars);

elgg_load_js('jquery.nouislider');
elgg_load_css('jquery.nouislider');
//elgg_load_js('jqueryui');
//elgg_load_css('jqueryui');
//elgg_load_js('baloon');

if (elgg_is_active_plugin('pages_tools'))
{
    $yesno_options = array(
        "yes" => elgg_echo("option:yes"),
        "no" => elgg_echo("option:no")
    );
    
    // comments allowed
    $allow_comments = "yes";
    if(!empty($entity)){
        $allow_comments = $entity->allow_comments;
    }
}    

$can_change_access = true;
if ($user && $entity) {
	$can_change_access = ($user->isAdmin() || $user->getGUID() == $entity->owner_guid);
}

//Comienza print de campos
echo elgg_view("input/hidden", array("name" => 'access_id', "value" => '1'));

if (!$parent_guid) {
//Si es una nueva historia
	if(!$vars["guid"]){
		echo elgg_view("input/hidden", array("name" => 'story_status', "value" => 'No'));}
	if($pageEdit->story_status=="No"){
		echo elgg_view("input/hidden", array("name" => 'story_status', "value" => '1'));}

		
	
	if(!($pageEdit->story_status) || $pageEdit->draft=="draft")
	{
		//Edito en draft
		if($pageEdit->story_status=="No")
		{
			echo elgg_view('input/hidden', array(
    		'name' => 'story_status',
    		'value' => "No",
			));}
			
		//$pageEdit->container_guid = $user->getGUID();
		echo elgg_view('input/hidden', array(
    		'name' => 'container_guid',
    		'value' => $user->getGUID(),
    	));
		
		if ($guid = elgg_extract("guid", $vars)) {
        echo elgg_view("input/hidden", array("name" => "page_guid", "value" => $guid));
		}
		
		if ($vars['guid']) {
    	echo elgg_view('input/hidden', array(
    		'name' => 'page_guid',
    		'value' => $vars['guid'],
    	)); }
		 
		echo "<br />";
		 echo "<div>";
	     echo "<label>" . elgg_echo("pages:title") . "</label>";
		 if(!$pageEdit->description || $pageEdit->description == "")
		 {
			$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>'storydraft', 'owner_guids' => elgg_get_logged_in_user_guid()));
			if($corpsedraft)
			{
				echo elgg_view("input/text", array('name' => 'title', 'value' => $corpsedraft[0]->title));
			}
			else
				echo elgg_view("input/text", array('name' => 'title', 'value' => $pageEdit->title));
		 }
		 else
			echo elgg_view("input/text", array('name' => 'title', 'value' => $pageEdit->title));
	     echo "</div>";
		 
		 echo "<br />";
		 echo "<div>";
		 echo "<label>" . elgg_echo("pages:description") . "</label>";
		 if(!$pageEdit->description || $pageEdit->description == "")
		 {
			$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>'storydraft', 'owner_guids' => elgg_get_logged_in_user_guid()));
			if($corpsedraft)
			{
				echo elgg_view("input/longtext", array('name' => 'description', 'value' => $corpsedraft[0]->description));
			}
			else
				echo elgg_view("input/longtext", array('name' => 'description', 'value' => $pageEdit->description));
		 }
		 else
			echo elgg_view("input/longtext", array('name' => 'description', 'value' => $pageEdit->description));
	     echo "</div>";
		 
		 echo "<br />";
		$cats = elgg_view("input/categories", $vars);
		if (!empty($cats)) {
			echo $cats;
		}
		 
		 echo "<br />";
		 echo "<div>";
	     echo "<label>" . elgg_echo("pages:tags") . "</label>";
		 if(!$pageEdit->description || $pageEdit->description == "")
		 {
			$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>'storydraft', 'owner_guids' => elgg_get_logged_in_user_guid()));
			if($corpsedraft)
			{
				echo elgg_view("input/tags", array('name' => 'tags', 'value' => $corpsedraft[0]->tags));
			}
			else
				echo elgg_view("input/tags", array('name' => 'tags', 'value' => $pageEdit->tags));
		 }
		 else
			echo elgg_view("input/tags", array('name' => 'tags', 'value' => $pageEdit->tags));
	     echo "</div>";
		 
		 echo "<br />";
		 echo "<div class=parent>";
		 echo "<div class=left>";
		 echo "<label class=droplabel id=\"wholabel\">" . elgg_echo("pages_tools:who_group") . "</label>";
		 echo "</div>";
		 echo "<div class=right id=\"whovalue\">";
		 echo elgg_view("input/dropdown", array("name" => "rating", "value" => $pageEdit->rating, "options_values" => array("1" => elgg_echo("pages_tools:no_rated"), "2" => elgg_echo("pages_tools:general"), "3" => elgg_echo("pages_tools:pg"), "3" => elgg_echo("pages_tools:pg13"), "4" => elgg_echo("pages_tools:r")))); echo "</div>"; 
	     echo "</div>";
		 
		 
		 echo elgg_view("input/hidden", array("name" => 'draft', "value" => 'publish'));	
		 
		 //echo "<br />";
		 //echo "<div class=parent>";
		 //echo "<div class=left>";
		 //echo "<label class=droplabel>" . elgg_echo("pages_tools:draft") . "</label>";
		 //echo "</div>";
		 //echo "<div class=right>";
		 //echo elgg_view("input/dropdown", array("name" => "draft", "value" => $vars["draft"], "options_values" => array("draft" => elgg_echo("pages_tools:option_draft"), "publish" => elgg_echo("pages_tools:publish_option"))));
	     //echo "</div>"; 
	     //echo "</div>";
		
		 
	}
	else{
		if($pageEdit->story_status=='No')
		{
			//Edito las opciones de la historia
			//echo elgg_view("input/hidden", array("name" => 'container_guid', "value" => $pageEdit->container_guid));
			//echo elgg_view("input/hidden", array("name" => 'storytype', "value" => $pageEdit->storytype));
			//echo elgg_view("input/hidden", array("name" => 'corpses_word_number', "value" => $pageEdit->corpses_word_number));
			//echo elgg_view("input/hidden", array("name" => 'corpses_word_number_max', "value" => $pageEdit->corpses_word_number_max));
			//echo elgg_view("input/hidden", array("name" => 'corpses_number', "value" => $pageEdit->corpses_number));
			echo elgg_view("input/hidden", array("name" => 'description', "value" => $pageEdit->description));
			echo elgg_view("input/hidden", array("name" => 'title', "value" => $pageEdit->title));	
			echo elgg_view("input/hidden", array("name" => 'draft', "value" => 'publish'));	
			echo elgg_view("input/hidden", array("name" => 'storytype', "value" => 'exqcorpse'));	
			echo elgg_view("input/hidden", array("name" => 'iscontainer', "value" => 'colective'));	
			echo elgg_view("input/hidden", array("name" => 'rating', "value" => 'rating'));
			
			echo "<script type=\"text/javascript\"> $(function() {
				$(\"#dropdownwho\").change(function() {
				var val = $(this).val();
				if (val=='chosen') {
					$(\"#pickuser1\").slideDown();
				} else {
					$(\"#pickuser1\").slideUp();
				}
				});
				});</script>";
			
			echo "<script type=\"text/javascript\"> $(function() {
				$(\"#iscontainer\").change(function() {
				var val = $(this).val();
				if (val=='onlyme') {
					$(\"#individualsettings\").slideDown();
					$(\"#corpsessettings\").slideUp();
				} else {
					$(\"#individualsettings\").slideUp();
					$(\"#corpsessettings\").slideDown();
				}
				});
				});</script>";
		
				echo "<script type=\"text/javascript\"> $(function() {
				$(\"#storytype\").change(function() {
				var val = $(this).val();
				if (val=='normal' || val=='gamebook') {
					$(\"#rounds\").slideUp();
					$(\"#corpsesnumber\").slideDown();
				}
				if (val=='exqcorpse'){
					$(\"#corpsesnumber\").slideUp();
					$(\"#rounds\").slideDown();
				}
				});
				});</script>";
				
				echo "<script type=\"text/javascript\"> $(function() {
				$(\"#dropdowncontainer\").change(function() {
			
					var val = $(this).val();
				
					$(\"#pickuser1\").slideUp();
				
					$('.centeredpicker').each(function() {
						$(this).slideUp();
					});	
					$('.centeredpicker').each(function() {
						if($(this).attr('id')== String(val))
						{
							$(this).slideDown();
						}
					});
				
				if($(\"#dropdownwho\").val()=='chosen')
				{
					$(\"#pickuser1\").slideDown();
				}
				});
				});</script>";
				
				
		 echo "<br />";	
		 echo "<div class=parent style=\"display: none\">";
		 echo "<div class=left>";
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:is_container") . "</label>";
		 echo "</div>";
		 echo "<div class=right>";
		 echo elgg_view("input/dropdowniscontainer", array("name" => "iscontainer", "value" => $vars["iscontainer"], "options_values" => array("colective" => elgg_echo("pages_tools:colective"), "onlyme" => elgg_echo("pages_tools:individual"))));
	     echo "</div>"; 
	     echo "</div>";
		 
		 echo "<div id=\"individualsettings\" style=\"display: none\">";
		 echo "<div class=parent>";
		 echo "<div class=left>";
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:story_type") . "</label>";
		 echo "</div>";
		 echo "<div class=right>";
		 echo elgg_view("input/dropdownindstory", array("name" => "indstorytype", "value" => $vars["indstorytype"], "options_values" => array("normal" => elgg_echo("pages_tools:normal"), "gamebook" => elgg_echo("pages_tools:gamebook"))));
	     echo "</div>"; 
	     echo "</div>";
		 echo "</div>";
		 
		 echo "<div id=\"corpsessettings\">";
		 echo "<div class=parent style=\"display: none\">";
		 echo "<div class=left>";
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:story_type") . "</label>";
		 echo "</div>";
		 echo "<div class=right>";
		 echo elgg_view("input/dropdownstory", array("name" => "storytype", "value" => $vars["storytype"], "options_values" => array( "exqcorpse" => elgg_echo("pages_tools:exquisitecorpse"), "normal" => elgg_echo("pages_tools:normal"), "gamebook" => elgg_echo("pages_tools:gamebook"))));
	     echo "</div>"; 
	     echo "</div>";
		
		 echo "<br />";
		 echo "<div class=parent id=\"corpsesnumber\">";
		 echo "<div class=left>";
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:corpses_number") . "</label>";
		 echo "</div>";
		 echo "<div class=right>";
		 echo "<div class=right1 id=\"slider\">";echo "</div>"; 
		 echo "<div class=right2>";echo elgg_view("input/corpsenumber", array('name' => 'corpses_number', 'value' => $pageEdit->corpses_number));echo "</div>"; 
		 echo "</div>"; 
	     echo "</div>";
		 
		 echo "<div class=parent id=\"rounds\">";
		 echo "<div class=left>";
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:corpses_rounds") . "</label>";
		 echo "</div>";
		 echo "<div class=right>";
		 echo "<div class=right1 id=\"sliderround\">";echo "</div>";
		 echo "<div class=right2>";echo elgg_view("input/corpserounds", array('name' => 'corpses_rounds', 'value' => $pageEdit->corpses_number));echo "</div>";
		 echo "</div>"; 
		 echo "</div>"; 

		 
		 echo "<br />";
		 echo "<br />";
		 echo "<div class=parent>";
		 echo "<div class=left>";
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:corpses_word_number") . "</label>";
		 echo "</div>";
		 echo "<div class=right id=\"sliderwords\">";
		 echo "</div>";
		 echo "</div>";
		 echo "<div class=parent>";
		 echo "<div class=right>";
		 echo "<div class=right3>"; 
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:corpses_word_number") . "</label>"; 
		 echo elgg_view("input/corpsewordnumber", array('name' => 'corpses_word_number', 'value' => $pageEdit->corpses_word_number));  echo "</div>";
		 echo "<div class=right2>"; 
		 echo "<label class=droplabel>" . elgg_echo("pages_tools:corpses_word_number_max") . "</label>";
	     echo elgg_view("input/corpsewordnumbermax", array('name' => 'corpses_word_number_max', 'value' => $pageEdit->corpses_word_number_max)); echo "</div>";
		 echo "</div>";
		 echo "</div>";
		 echo "<br />";
	
		 if ($containers){
		 echo "<br />";
		 echo "<div class=parent>";
		 echo "<div class=left>";
		 echo "<label class=droplabel>" . elgg_echo("container") . "</label>";
		 echo "</div>";
		 echo "<div class=right>";
		 echo $containers;
		 echo "</div>"; 
	     echo "</div>";
		}
		
		 echo "<br />";
		 echo "<div class=parent>";
		 echo "<div class=left>";
		 echo "<label class=droplabel id=\"wholabel\">" . elgg_echo("pages_tools:who_group") . "</label>";
		 echo "</div>";
		 echo "<div class=right id=\"whovalue\">";
		 echo elgg_view("input/dropdownwho", array("name" => "whogroup", "value" => $pageEdit->whogroup, "options_values" => array("everyone" => elgg_echo("pages_tools:everyone"), "chosen" => elgg_echo("pages_tools:chosen")))); echo "</div>"; 
	     echo "</div>";
		 
		$content = elgg_get_entities_from_relationship(array(
        'type' => 'group',
        'relationship' => 'member',
        'relationship_guid' => $logged_in_user->guid,
        'inverse_relationship' => false,
        'limit' => 0,
		));
		
		$contentguids = array();
		
		foreach ($content as $container) {
			array_push($contentguids, $container->guid);
		}
		
		$contentguid = array_unique($contentguids);
		
		
		echo "<br />";
		echo "<br />";
		echo "<div id=\"pickuser1\" class=parent>";
		  	 
		 echo "<div>";
	     echo "<label>" . elgg_echo("pages_tools:who_picked") . "</label>"; echo "</div>";
		
		echo "<div id=\"containercount\">";
		foreach ($contentguid as $containeritem) {
        //$containers[$container->guid ] =   elgg_echo('group') . ': ' . $container->get('name');
		//$containers[$container->guid ] =  $container->get('name');
		 echo "<div id=\"" . $containeritem . "\" class=centeredpicker>";
		 echo "<br />";
		 echo elgg_view("input/friendspicker", array('name' => 'who_picked' . $containeritem , 'value' => $pageEdit->who_picked, 'entities' => get_group_members($containeritem,100), 'highlight' => 'all'));
		 echo "</div>";
		 }
		 echo "</div>";
		 echo "</div>";
		 echo "</div>";
		 
				echo "<script type=\"text/javascript\">function hideDivs() {
				var iscontainerval = $(\"#iscontainer\").val();
				if (iscontainerval=='onlyme') {
					$(\"#individualsettings\").slideDown();
					$(\"#corpsessettings\").slideUp();
				} else {
					$(\"#individualsettings\").slideUp();
					$(\"#corpsessettings\").slideDown();
				}
				
				var storyval = $(\"#storytype\").val();
				if (storyval=='normal' || storyval=='gamebook') {
					$(\"#rounds\").slideUp();
					$(\"#corpsesnumber\").slideDown();
				}
				if (storyval=='exqcorpse'){
					$(\"#corpsesnumber\").slideUp();
					$(\"#rounds\").slideDown();
				}
				
				var chooseval = $(\"#dropdownwho\").val();
				if (chooseval=='chosen') {
					$(\"#pickuser1\").slideDown();
				} else {
					$(\"#pickuser1\").slideUp();
				}
				
				var dropdowncontainer = $(\"#dropdowncontainer\").val();
				
					$('.centeredpicker').each(function() {
						$(this).slideUp();
					});	
					$('.centeredpicker').each(function() {
						if($(this).attr('id')== String(dropdowncontainer))
						{
							$(this).slideDown();
						}
					});
				
				if($(\"#dropdownwho\").val()=='chosen')
				{
					$(\"#pickuser1\").slideDown();
				}
				};
				hideDivs();</script>";	
			
			echo "<script type=\"text/javascript\"> function createSlider(){
		 $(\"#slider\").noUiSlider({
    range: [0, 80],
    start: 0,
    handles: 1,
	step: 1,
	serialization: {
        to: [$('#corpsenumber')], resolution: 1
    }
});
$(\"#sliderround\").noUiSlider({
    range: [0, 10],
    start: 0,
    handles: 1,
	step: 1,
	serialization: {
        to: [$('#corpserounds')], resolution: 1
    }
});
		
		$(\"#sliderwords\").noUiSlider({
    range: [0, 10000],
    start: [2000, 8000],
    handles: 2,
	step: 100,
	serialization: {
        to: [$('#corpserminwords'), $('#corpsermaxwords')], resolution: 1
    }
});}; createSlider();
		</script>";
	
		}
	}
}
else
{
	//Corpses
	$story = get_entity($parent_guid);
	echo elgg_view("input/hidden", array("name" => 'iscontainer', "value" => $story->iscontainer));
	echo elgg_view("input/hidden", array("name" => 'container_guid', "value" => $story->container_guid));
	echo elgg_view("input/hidden", array("name" => 'storytype', "value" => $story->storytype));
	echo elgg_view("input/hidden", array("name" => 'indstorytype', "value" => $story->indstorytype));
	echo elgg_view("input/hidden", array("name" => 'corpses_word_number', "value" => $story->corpses_word_number));
	echo elgg_view("input/hidden", array("name" => 'corpses_word_number_max', "value" => $story->corpses_word_number_max));
	echo elgg_view("input/hidden", array("name" => 'corpses_number', "value" => $story->corpses_number));
	echo elgg_view("input/hidden", array("name" => 'story_status', "value" => $story->story_status));
	echo elgg_view("input/hidden", array("name" => 'access_id', "value" => ACCESS_LOGGED_IN));	
	echo elgg_view("input/hidden", array("name" => 'draft', "value" => 'draft'));
	
	foreach ($variables as $name => $type) {
				// don't show read / write access inputs for non-owners or admin when editing
				if (($type == 'access' || $type == 'write_access') && !$can_change_access) {
					continue;
				}
	
				if ($name == "write_access_id"){
					continue;
				}

				// don't show parent picker input for top or new pages.
				if ($name == 'parent_guid') {
					continue;
				}

				if ($type == 'parent') {
					$input_view = "pages/input/$type";
				} else {
					$input_view = "input/$type";
				}

			?>
			<div>
			<label><?php echo elgg_echo("pages:$name") ?></label>
			<?php
				if ($type != 'longtext') {
					echo '<br />';
				}
				if($name!='description' && $name!='title')
				echo elgg_view($input_view, array(
					'name' => $name,
					'value' => $vars[$name],
					'entity' => ($name == 'parent_guid') ? $vars['entity'] : null,
				));
				else
				{
					if(!$vars['description'] || $vars['description']=="")
					{
						$corpsedraft = elgg_get_entities(array('types' =>'object', 'subtypes'=>'corpsedraft', 'owner_guids' => elgg_get_logged_in_user_guid(), 'container_guids' => $parent_guid));
						if($corpsedraft)
						{
							if($name=='description')
								echo elgg_view($input_view, array('name' => $name, 'value' => $corpsedraft[0]->description));
							if($name=='title')
								echo elgg_view($input_view, array('name' => $name, 'value' => $corpsedraft[0]->title));
						}
						else
							echo elgg_view($input_view, array(
								'name' => $name,
								'value' => $vars[$name],
								'entity' => ($name == 'parent_guid') ? $vars['entity'] : null,
							));
					}
					else
						echo elgg_view($input_view, array(
							'name' => $name,
							'value' => $vars[$name],
							'entity' => ($name == 'parent_guid') ? $vars['entity'] : null,
						));
					
				}
			?>
			</div>
			<?php
			}
			
			//echo "<br />";
			//echo "<div class=parent>";
			//echo "<div class=left>";
			//echo "<label>" . elgg_echo("pages_tools:allow_comments") . "</label>";
			//echo "</div>";
			//echo "<div class=right>";
			//echo elgg_view("input/dropdown", array("name" => "allow_comments", "value" => $allow_comments, "options_values" => $yesno_options));		echo "</div>"; 
			//echo "</div>";
			
			echo elgg_view("input/hidden", array("name" => 'allow_comments', "value" => 'yes'));	
		

}

$vars['write_access_id']=ACCESS_PUBLIC;	

	// support for categories
	if($canchoosestorytype){
		$cats = elgg_view("input/categories", $vars);
		if (!empty($cats)) {
			echo $cats;
		}
	}

if (elgg_is_active_plugin('pages_tools')){
    // add support to disable commenting
    
    // advanced puplication options
    if(pages_tools_use_advanced_publication_options()){
        if(!empty($entity)){
            $publication_date_value = $entity->publication_date;
            $expiration_date_value = $entity->expiration_date;
        }
        
        if(empty($publication_date_value)){
            $publication_date_value = "";
        }
        
        if(empty($expiration_date_value)){
            $expiration_date_value = "";
        }
        
        $publication_date = "<div class='mbs'>";
        $publication_date .= "<label for='publication_date'>" . elgg_echo("pages_tools:label:publication_date") . "</label>";
        $publication_date .= elgg_view("input/date", array(
                                        "name" => "publication_date", 
                                        "value" => $publication_date_value));
        $publication_date .= "<div class='elgg-subtext'>" . elgg_echo("pages_tools:publication_date:description") . "</div>";
        $publication_date .= "</div>";
        
        $expiration_date = "<div class='mbs'>";
        $expiration_date .= "<label for='expiration_date'>" . elgg_echo("pages_tools:label:expiration_date") . "</label>";
        $expiration_date .= elgg_view("input/date", array(
                                        "name" => "expiration_date", 
                                        "value" => $expiration_date_value));
        $expiration_date .= "<div class='elgg-subtext'>" . elgg_echo("pages_tools:expiration_date:description") . "</div>";
        $expiration_date .= "</div>";
        
        echo elgg_view_module("info", elgg_echo("pages_tools:label:publication_options"), $publication_date . $expiration_date);
    }
    
    // final part of the form
    echo "<div class='elgg-foot'>";
    // send the guid of the page we"re editing
    if ($guid = elgg_extract("guid", $vars)) {
        echo elgg_view("input/hidden", array("name" => "page_guid", "value" => $guid));
    }
	
	// send the status of the new story
   // if ($guid = elgg_extract("guid", $vars)) {
    //    echo elgg_view("input/hidden", array("name" => "page_guid", "value" => $guid));
  //  }
    // send the parent guid of the page (on new pages only)
    if (!$vars["guid"] && $parent_guid) {
        echo elgg_view("input/hidden", array("name" => "parent_guid", "value" => $parent_guid));
    }
	
	if($pageEdit->story_status=='0' )
	{
		echo elgg_view("input/hidden", array("name" => "story_status", "value" => '1'));
	}
	
	if($pageEdit->story_status=='1' )
	{
		echo elgg_view("input/hidden", array("name" => "story_status", "value" => '2'));
	}
	
	
}
else 
{
    echo '<div class="elgg-foot">';
    if ($vars['guid']) {
    	echo elgg_view('input/hidden', array(
    		'name' => 'page_guid',
    		'value' => $vars['guid'],
    	));
    }
    
    if (!$vars['guid']) {
    	echo elgg_view('input/hidden', array(
    		'name' => 'parent_guid',
    		'value' => $vars['parent_guid'],
    	));
    }
}
echo "<br />";
$submitname = null;
if(!$parent_guid)
	$submitname = 'save';
else
	$submitname = 'pages_tools:save_revision';
	
echo elgg_view('input/submit', array('value' => elgg_echo($submitname), 'class' => 'elgg-button elgg-button-submit'));



echo '</div>';
