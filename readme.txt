///////****** Wordpress 1.2 Plugin - suggest ******\\\\\\

Author: David Linsin
URL: http://blog.linsin.de/index.php/archives/2004/12/23/wordpress-plugin-suggest/
Version: 0.2
Date: 05/01/08



This plugin enables a feature called "suggest". Whenever you 
type a character in the search field of your blog site, suggestions 
are being presented. You can select these suggestions and hit enter, 
to execute a search request.

For this plugin I used a javascript "library" of Google's Suggest 
Search. I modified it, to adjust style and functionality , so that 
it works with Wordpress. I tested it with Firefox 1.0 and IE 6.0 (SP1). 



Files: suggest.php - plugin file used by Wordpress
	   /suggest/suggest_data.php - fetches data from Wordpress database
	   /suggest/ac.js - modified javascript library
	   
	   

Installation:

1. Copy "suggest.php" and folder (and content) "suggest" into /wp-content/plugins directory.

2. Open index.php and search for a html form called "searchform" (in my case I searched for '<form id="searchform"')
   Add a name to the form tag: 'name="searchform"'
   Add the attribute 'autocomplete="off"' to the input field with the id "s"
   Change button name from "submit" to "subButton"
   
   my original form:
   
   <form id="searchform" method="get" action="<?php echo $PHP_SELF; ?>">
   	<div>
   		<input type="text" name="s" id="s" size="15" /><br />
   		<input type="submit" name="submit" value="<?php _e('Search'); ?>" />
   	</div>
   </form>
   
   my form after modification:
   
   <form id="searchform" name="searchform" method="get" action="<?php echo $PHP_SELF; ?>">
   	<div>
   		<input type="text" name="s" id="s" size="15" autocomplete="off"/><br />
   		<input type="submit" name="subButton" value="<?php _e('Search'); ?>" />
   	</div>
   </form>
   
3. Activate plugin


Known Bugs of version 0.2:

- Problems with IE, I deactivated the results count, cause there are problems displaying it correctely
- Style is static, so far you need to modifiy the JavaScript file
- Doesn't work with OmniWeb (Mac OS browser)


Change log:

version 0.1 -> 0.2: - suggest_data.php (better suggestions)



