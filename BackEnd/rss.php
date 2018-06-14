<?php
	include("config.php");
	header('Content-Type: text/xml; charset=utf-8', true);

	$rss = new SimpleXMLElement('<rss version="2.0"></rss>');

	$channel = $rss->addChild('channel');

	$title = $channel->addChild('title','Autographcoll');
	$description = $channel->addChild('description','The RSS report.');
	$link = $channel->addChild('link','http://www.autographcoll.com');
	$language = $channel->addChild('language','en-us');

	$results = $conn->query("SELECT Id, Name, Description, Price, Category FROM Autograph");

	if($results){ 
		while($row = $results->fetch_object())
		{
			$item = $channel->addChild('item'); 
			$title = $item->addChild('title', $row->Name); 
			$guid = $item->addChild('guid', $row->Id);
			$description = $item->addChild('description', htmlentities($row->Description) ); 
			$category = $item->addChild('category', $row->Category);
			
			$date_rfc = gmdate(DATE_RFC2822, strtotime($row->Price));
		}
	}

	$myfile = fopen("../FrontEnd/rss.xml", "w");
	fwrite($myfile, $rss->asXML());
	fclose($myfile);
	header( 'Location: ../FrontEnd/rss.xml' );
?>
