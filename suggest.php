<?php
	/*
	Plugin Name: suggest
	Plugin URI: http://blog.linsin.de/index.php/archives/2004/12/23/wordpress-plugin-suggest/
	Description: This plugin enables a feature like Google's suggest search. When typing characters in your blog search field suggestions are being presented.
	Version: 0.1
	Author: David Linsin
	Author URI: http://blog.linsin.de/
	*/

	/** PLUGIN functions **/

    global $suggest_path, $scriptPathSet;
    $suggest_path = "/wp-content/plugins/suggest/" ;


    function insert_googleScript()
    {
		global $suggest_path, $scriptPathSet;
		$scriptPathSet = true;?>
        <script src="<?echo $suggest_path;?>ac.js"></script> <?php
    }


    function insert_suggestLoad()
    {
        global $suggest_path, $scriptPathSet;
		if($scriptPathSet) {?>
        <script>InstallAC(document.searchform,document.searchform.s,document.searchform.subButton,"<?php echo $suggest_path; ?>suggest_data.php","en");</script>
		<?php
			$scriptPathSet = false;
		}
    }


 	/** PLUGIN hooks **/
    add_action('wp_head','insert_googleScript');
    add_action('shutdown','insert_suggestLoad');
?>
