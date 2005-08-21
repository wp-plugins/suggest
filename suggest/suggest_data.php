<?php
// Copyright (C) David Linsin
// version 0.6

include('../../../wp-config.php');

// WP 1.5 (pre-release) support
if(empty($qu)) {
$qu = $_REQUEST['qu'];
}

if(!empty($qu)) {
	$query = "select distinct post_content as val from $tableposts where post_status in ('publish','static') and post_content like '%".$qu."%' order by val";

	$db_values = $wpdb->get_results($query);
	$result = "sendRPCDone(frameElement, \"".$qu."\", new Array(";
	$i = 0;
	$k = 0;
	$exists = false;
	$previous;
	// construct js array with suggest values
	foreach($db_values as $res) {
		$text = $res->val;

		// only words that starts with $qu e.g. Ju or ju or JU
		preg_match_all('/(\b'.ucwords($qu).'[^[:space:]]*.)|(\b'.strtolower($qu).'[^[:space:]]*.)|(\b'.strtoupper($qu).'[^[:space:]]*.)/', $text, $match);

		// for all matched words of post
		foreach($match[0] as $word) {

			// get rid of numbers and none word characters
			preg_match('/[a-zA-Z]*/', $word, $word_match);
			$word = $word_match[0];

			// check if already used
			for($j = 0; $j < sizeof($previous); $j++) {
				if($word == $previous[$j][0]) {
					$previous[$j][1]++;
					$exists = true;
					break;
				}
			}

			// if text does not exist && the max suggestions aren't reched
			if(!$exists && $k < $MAX_SUGGESTIONS) {
				if($i == 0) {
					$result = $result . "\"" . $word . "\"";
				}
				else {
					$result = $result . ",\"" . $word . "\"";
				}
				$previous[$k][0] = $word;
				$previous[$j][1]++;
				$k++;
			}

			$i++;
			$exists = false;
		}
	}
	$result = $result . "), new Array(";
	// construct js array with number of results
	for($i=0; $i < sizeof($previous); $i++) {
		$text = $previous[$i][1];
		if($i == 0) {
			$result = $result . "\"" . $text . "\"";
		}
		else {
			$result = $result . ",\"" . $text . "\"";
		}
	}

	$result = $result . "), new Array(\"\"));";
	echo $result;
}
?>