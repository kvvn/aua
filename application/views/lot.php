<html>
<head>
<title></title>
</head>
<body>
    <?php foreach($attachments as $attacment):?>
        <img src="<?php echo $attacment['url_2'];?>"/><br/>
    <?php endforeach;?>
    <?php echo $lot[0]['text'];?><br/>
    <?php foreach($bets as $bet):?>
        <?php echo $bet['text'];?><br/>
    <?php endforeach;?>
</body>
</html>