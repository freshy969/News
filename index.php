<?php
		//Feed URLs
        $feeds = array("http://news.thedoctorwhosite.co.uk/feed/",
        	"http://www.trektoday.com/content/feed/",
        	"http://www.wdwmagic.com/news/rss.xml",
        	"http://www.jabberjays.net/feed/",
        	"http://magical-menagerie.com/feed/",
        	"http://iamdivergent.com/feed/");
        
        //Read each feed's items
        $entries = array();
        foreach($feeds as $feed) {
            $xml = simplexml_load_file($feed);
            $entries = array_merge($entries, $xml->xpath("//item"));
        }
        
        //Sort feed entries by pubDate
        usort($entries, function ($feed1, $feed2) {
            return strtotime($feed2->pubDate) - strtotime($feed1->pubDate);
        });
?>
<html>
	<head>
		<title>News</title>
		<link href="fonts/stylesheet.css" rel="stylesheet" type="text/css">
		<link href="css/styles.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div id="wrapper" class="wrapper">
		<div id="header">
        <img src="icons/menu.png" id="mm-menu-toggle" class="mm-menu-toggle"/>
        <div id="hub"><img src="icons/default.png"/></div>
        <div id="logo">News</div>
      </div>
      <div class="container">
      <div id="all">
		<?php
        //Print all the entries
        foreach($entries as $entry){
            ?>
            <div id="oneline">
            <a href="http://<?= parse_url($entry->link)['host'] ?>" target="_blank" id="site"><?= parse_url($entry->link)['host'] ?></a><br>
            <a href="<?= $entry->link ?>" target="_blank" id="headline"><p><?= $entry->title ?></p></a>
            <p id="day"><?= strftime('%m/%d/%Y', strtotime($entry->pubDate)) ?></p>
            <!--<p><?= $entry->description ?></p><br></a>
            <div id="readm"><a href="<?= $entry->link ?>" target="_blank" id="rssa">Read more</a></div>-->
        </div>
            <?php
        }
        ?>
     </div>
 </div>
</div>
<nav id="mm-menu" class="mm-menu">
  <div class="mm-menu__header">
    <h2 class="mm-menu__title">Filter</h2>
  </div>
  <ul class="mm-menu__items">
    <li class="mm-menu__item">
      <a class="mm-menu__link" href="#">
        <span class="mm-menu__link-text"> Doctor Who</span>
      </a>
    </li>
    <li class="mm-menu__item">
      <a class="mm-menu__link" href="#">
        <span class="mm-menu__link-text"> Game of Thrones</span>
      </a>
    </li>
    <li class="mm-menu__item">
      <a class="mm-menu__link" href="#">
        <span class="mm-menu__link-text"> Disney</span>
      </a>
    </li>
    <li class="mm-menu__item">
      <a class="mm-menu__link" href="#">
        <span class="mm-menu__link-text">Star Trek</span>
      </a>
    </li>
    <li class="mm-menu__item">
      <a class="mm-menu__link" href="#">
        <span class="mm-menu__link-text"> Hunger Games</span>
      </a>
    </li>
  </ul>
</nav><!-- /nav -->

<script src="js/materialMenu.js"></script>
<script>
  var menu = new Menu;
</script>
	</body>
</html>
