<?php
	/*
	Plugin Name: suggest
	Plugin URI: http://blog.linsin.de/index.php/archives/2004/12/23/wordpress-plugin-suggest/
	Description: This plugin enables a feature like Google's suggest search. When typing characters in your blog search field suggestions are being presented.
	Version: 0.3
	Author: David Linsin
	Author URI: http://blog.linsin.de/
	*/

/** CONFIGURATION */

    global $suggest_path, $scriptPathSet, $MAX_SUGGESTIONS, $COLOR_MARKED_ROW, $COLOR_RESULTS, $COLOR_SUGGEST;

	// change path to suggest plugin e.g. if your blog is situated in 'http://blog.linsin.de/wp' change path to '/wp/wp-content/plugins/suggest/'
    $suggest_path = "/wp-content/plugins/suggest/" ;
	// max number of suggestions presented, notice that this is just a limit no order is being applied
	$MAX_SUGGESTIONS = 10;
	// color of marked row
	$COLOR_MARKED_ROW = "#DF1111";
	// color results
	$COLOR_RESULTS = "#DF1111";
	// color suggestion
	$COLOR_SUGGEST = "black";
	// font of suggestions and results
	$TEXT_FONT = "arial,sans-serif";

/** PLUGIN functions **/

    function insert_googleScript()
    {
		global $suggest_path, $scriptPathSet;
		$scriptPathSet = true;?>
        <script type="text/javascript" src="<?echo $suggest_path;?>ac.js"></script><?php
    }


    function insert_suggestLoad()
    {
        global $suggest_path, $scriptPathSet, $COLOR_MARKED_ROW, $COLOR_RESULTS, $COLOR_SUGGEST, $TEXT_FONT;
		if($scriptPathSet) {?>
        <script>InstallAC(document.searchform,document.searchform.s,document.searchform.subButton,"<?php echo $suggest_path; ?>suggest_data.php","en","","","",<?php echo "\"".$COLOR_MARKED_ROW."\", \"".$COLOR_RESULTS."\", \"".$COLOR_SUGGEST."\", \"".$TEXT_FONT."\"";?>);</script>
		<?php
			$scriptPathSet = false;
		}
    }


 	/** PLUGIN hooks **/
    add_action('wp_head','insert_googleScript');
    add_action('shutdown','insert_suggestLoad');
?>
