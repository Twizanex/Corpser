<?php
/**
 * Elgg display long text
 * Displays a large amount of text, with new lines converted to line breaks
 *
 * @package Elgg
 * @subpackage Core
 * (<([a-zA-Z]+)((.(?!<\/)(?!<[a-zA-Z]))*?[^?])?>|<\/ ([a-zA-Z]+)((.(?!<\/)(?!<[a-zA-Z]))*?[^?])?>|[^ ]+)
 * @uses $vars['value'] The text to display
 * @uses $vars['parse_urls'] Whether to turn urls into links. Default is true.
 * @uses $vars['class']
 */


$class = 'elgg-output';
$additional_class = elgg_extract('class', $vars, '');
if ($additional_class) {
	$vars['class'] = "$class $additional_class";
} else {
	$vars['class'] = $class;
}

$parse_urls = elgg_extract('parse_urls', $vars, true);
unset($vars['parse_urls']);

$text = $vars['value'];
unset($vars['value']);

if ($parse_urls) {
	$text = parse_urls($text);
}

$text = filter_tags($text);

$text = elgg_autop($text);
$text = str_replace('</p>', ' </p> ', $text);
$text = str_replace('<p><', '<p> <', $text);
$text = str_replace('<br>', ' <br> ', $text);
$text = str_replace('<br />', ' <br /> ', $text);
$text = str_replace('<hr>', ' <hr> ', $text);
/*$book = null;
if(!$book = pages_tools_create_epub($vars['page']))
{
	register_error(elgg_echo("pages_tools:error:no_epub"));
	forward(REFERER);
}*/

$attributes = elgg_format_attributes($vars);
echo '<div id="book">'.$book.'</div>';
echo "<div class=\"inside\"><div class=\"insidetext\">$text</div></div>";

echo "<div class=\"outside\">
  <span id=\"slider-prev\"></span> <span id=\"slider-next\"></span>";

/*echo "<script type=\"text/javascript\"> 

function paginateText(){

	var currentCol = $('.col:first');
	var text = currentCol.html();
	currentCol.text('');
	var wordArray=text.match(/(<([a-zA-Z]+)((.(?!<\/)(?!<[a-zA-Z]))*?[^?])?>|<\/ ([a-zA-Z]+)((.(?!<\/)(?!<[a-zA-Z]))*?[^?])?>|[^ ]+)/g);

	$.fn.hasOverflow = function() {
		var div= document.getElementById($(this).attr('id')); 
		return div.scrollHeight > div.clientHeight;
	};

	var c = 2;
	var tags = new Array();
	var wordtag;
	
	for(var x=0; x<wordArray.length; x++){
		
		var word= wordArray[x];
		var matches = word.match(/<([a-zA-Z]+)((.(?!<\/)(?!<[a-zA-Z]))*?[^?])?>/g);
		var wordbuffer = word;

		if(matches != null)
		{
			
			for(var i=0; i<matches.length; i++)
			{	
				
				wordtag = matches[i];
				if(matches[i].match(/<br>/)==null && matches[i].match(/<hr>/)==null)
				{tags.push(matches[i]);}
			}
		}
		
		wordbuffer = word;
		matches = word.match(/<\/([a-zA-Z]+)((.(?!<\\/)(?!<[a-zA-Z]))*?[^?])?>/g);
		if(matches != null)
		{
			for(var i=0; i<matches.length; i++)
			{tags.pop();}
		}
		
		currentCol.text(currentCol.text() + word + ' ');
		
		var buff = currentCol.text();
		currentCol.html(currentCol.text());
		
		if (currentCol.hasOverflow()){ 
			var n = buff.lastIndexOf(wordbuffer);
			buff = buff.substring(0, n);
			currentCol.html('');
			currentCol.text(buff);
			x--;

			var copyArray = new Array();
			for(var i = 0, l = tags.length; i < l; ++i)
				copyArray.push(tags[i]);
			
			for(var i = tags.length -1; i >= 0; i--)
			{
				var matchtag = copyArray[i].match(/<([a-zA-Z]+)/g);
				var tagend = matchtag[0].replace('<','');
				currentCol.text(currentCol.text() + '</' + tagend+ '> ');
			}
			
			buff = currentCol.text();
			currentCol.html('<p style=\"text-align: justify;\"></p>');
			currentCol.html(buff);
			currentCol = $('<li></li>').addClass('col').attr('id', 'col'+ c.toString());
			currentCol.appendTo( $('#slidercorpsetext') );
		
			for(var i = 0, l = tags.length; i < l; ++i)
				currentCol.text(currentCol.text() + tags[i]+' ');
			c++;
		}
		else
		{
			currentCol.html('<p style=\"text-align: justify;\"></p>');
			currentCol.text(buff);
		}
			
	}
	currentCol.html(currentCol.text());
}

var slider = null;

function createSlider(){
  slider = $('.bxslider').bxSlider({
  slideMargin: 200,
  speed: 1000,
  pagerType: 'short',
  nextSelector: '#slider-next',
  prevSelector: '#slider-prev',
  nextText: '→',
  prevText: '←',
  infiniteLoop: false,
  hideControlOnEnd: true,
  keyboardEnabled: true,
  touchEnabled: true,
   
});

}
paginateText();
createSlider();
</script>";*/