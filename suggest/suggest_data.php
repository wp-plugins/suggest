<?
// David Linsin
// version 0.3

include('../../../wp-config.php');

if(!empty($qu)) {
	$query = "select distinct post_content as val from $tableposts where post_content like '%".$qu."%' order by val";

	$db_values = $wpdb->get_results($query);
	$result = "sendRPCDone(frameElement, \"".$qu."\", new Array(";
	$i = 0;
	$k = 0;
	$exists = false;
	$exit = false;
	$previous;
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
				if($word == $previous[$j]) {
					$exists = true;
					break;
				}
			}
	
			// if text does not exist
			if(!$exists) {
				if($i == 0) {
					$result = $result . "\"" . $word . "\"";
				}
				else {
					$result = $result . ",\"" . $word . "\"";
				}
				$previous[$k] = $word;
				$k++;
			}
			
			$i++;
			$exists = false;
			
			// exit if max suggestions reached
			if($k >= $MAX_SUGGESTIONS) {
				$exit = true;
				break;
			}
		}
		// if max suggestions reached exit
		if($exit) {
			break;
		}
	}
	$result = $result . "), new Array(";

	for($i=0; $i < sizeof($previous); $i++) {
		$query = "select distinct count(*) as cnt from $tableposts where post_content like '%".addslashes($previous[$i])."%'";
		$res = $wpdb->get_row($query);
		$text = $res->cnt;
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





