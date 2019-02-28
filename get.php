<?php
include("class.template.php");
include("class.content.php");

include("mysql.php");

foreach ( $_POST as $get => $val )  {	
	
	if ($get=="templ"){	
		$t = $val;
	} else {
		if ($get<>"function"){	
			$IN[$get] = $val;
		} else {
			$f = $val;
			$t = $val;
		}
	}
}



$page = new getContent($f,$t,$IN);
echo $page->go();



?>