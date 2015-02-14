<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">

        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class="jumbotron">
                        <h2>
                            Ультрас Аукционы 
                        </h2>
                        <p>
                            Українські футбольні фанати були однією з основних сил революції. Зараз, під час війни з російськими окупантами, фанати не залишились осторонь, сотні ультрас без коливань відправились на передову. А ті, хто залишився, роблять все можливе для того, щоб допомогти своїм побратимам. Причому ультрас вигадують найрізноманітніші способи, де роздобути кошти для придбання амуніції бійцям. Одним з найбільш розповсюджених способів стали благодійні аукціони. Перші аукціони з’явились ще півроку тому. Мабуть, буде справедливо сказати, що ідея таких аукціонів належить фанату із Запоріжжя, але починалось все з лотів, не пов’язаних з футболом. Зараз фанати майже кожного клубу збирають кошти на допомогу бійцям подібним чином, а потім звітують про те, як вони їх витратили. 
                        </p>
                        <p>
                            <a class="btn btn-primary btn-large" href="http://ultras.org.ua/01428.html">Дальше на http://ultras.org.ua</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-3 column" align="middle">
                    <?php foreach ($auctions as $auction): ?>
                        <p>
                            <a href="http://vk.com/<?php echo $auction['url']; ?>">
                                <img src="<?php echo $auction['avatar_url'] ?>" /><br/>
                            </a>
                        </p>    
                    <?php endforeach; ?>
                </div>
                <div class="col-md-9 column">
                    <div class="row clearfix">
                        <?php $i = 0; ?>
                        <?php foreach ($lots as $lot): ?>
                            <?php $i++; ?>
                            <div class="col-md-4 column" align="middle" >
                                <h2>

                                    <img src="<?php echo $lot['attachments'][0]['url_1']; ?>"/><br/>

                                </h2>
                                <p>
                                    <?php echo $lot['text']; ?><br/>
                                </p>
                                <p>
                                    Ставок:<?php echo $lot['comments']; ?><br/>
                                    <a class="btn" href ="<?php echo base_url();?>lot/<?php echo $lot['id']; ?>">Подробнее »</a>
                                </p>
                            </div>
                            <?php if ($i % 3 == 0 && $i % 18 != 0): ?>
                            </div>
                            <div class="row clearfix">
                            <?php elseif ($i % 18 == 0): ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <nav>
                <ul class="pager">
                    <?php if ($page != 0): ?>
                        <li><a href="<?php echo base_url() . $page - 1;?>">Назад</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo base_url() . $page + 1;?>">Дальше</a></li>
                </ul>
            </nav>
        </div>
    </body>
</html>