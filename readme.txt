///////****** Wordpress 1.2 Plugin - suggest ******\\\\\\

Author: David Linsin
URL: http://blog.linsin.de/index.php/archives/2004/12/23/wordpress-plugin-suggest/
Version: 0.4
Date: 05/01/16



This plugin enables a feature called "suggest". Whenever you 
type a character in the search field of your blog site, suggestions 
are being presented. You can select these suggestions and hit enter, 
to execute a search request.

For this plugin I used a javascript "library" of Google's Suggest 
Search. I modified it, to adjust style and functionality , so that 
it works with Wordpress. I tested it with Firefox 1.0 and IE 6.0 (SP1). 



FILES: suggest.php - plugin file used by Wordpress
	   /suggest/suggest_data.php - fetches data from Wordpress database
	   /suggest/ac.js - modified javascript library
	   
	   

INSTALLATION / CONFIGURATION:

1. Copy "suggest.php" and folder (and content) "suggest" into /wp-content/plugins directory.
   Depending on the URI of your blog, you might need to configure the directory of the plugin (step 4).

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

4. Open "suggest.php" to configure the plugin. Since version 0.3, it's possible to configure colors and font
   of the dropdown, presenting the suggestions. Furthermore it's possible to configure the 
   number of suggestions presented. You can also configure the directory of the plugin, which might be 
   necessary for your blog. Since version 0.4, it's possible to enable or disable the output of 'x results' for
   Internet Explorer.


KNOWN BUGS OF VERSION 0.4:

- not XHTML valid due to missing plugin hook


TESTED BROWSERS:

Mozilla Firefox 1.0 - no problems
Internet Explorer 6.0 SP1 - known problems displaying results, won't be fixed
Opera 7.54 - not working, cause XMLHttpRequest is not supported
Safari 1.2.4 - no problems



CHANGELOG:

version 0.1 -> 0.2: - suggest_data.php (better suggestions)

version 0.2 -> 0.3: - suggest_data.php
					  * added version header
					  * improved search results (problems with upper and lower cases)
					  * added max number of suggestions
					- suggest.php
					  * added global configuration parameters
					  * changed output of insertGoogleScript for XHTML validation
					  * changed output of insertSuggestLoad for configuration of style
					- ac.js
					  * added version header
					  * changed method InstallAC for configuration of style
					  * added variables for style
					  * changed method l for configuration of style
					  
version 0.3 -> 0.4:	- suggest_data.php
					  * added wordpress 1.5 support
					- suggest.php
					  * added global configuration parameter to configure output of 'x results' with IE
					- ac.js
					  * changes method rb to enable configuration of 'x results' output with IE

LICENSE for suggest.php & suggest_data.php:

Copyright (C) David Linsin

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


