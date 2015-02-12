<html>
<head>
<title></title>
</head>
<body>
	

<ul>
<?php foreach($lots as $lot):?>
<!--<?php print_r($lot)?>-->
<li><?php echo $lot['text'];?><br/>
<?php foreach($lot['attachments'] as $attacment):?>
    <img src="<?php echo $attacment['url_1'];?>"/><br/>
<?php endforeach;?>
    Ставок:<?php echo $lot['comments'];?><br/>
    <a href ="lot/index/<?php echo $lot['id'];?>">Подробнее</a>
</li>

<?php endforeach;?>
</ul>
	
</body>
</html>