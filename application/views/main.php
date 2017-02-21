<div class="row clearfix">
    <div class="col-md-3 column" align="middle">
        <?php foreach ($auctions as $auction): ?>
            <p>
                <a href="http://vk.com/<?php echo (!empty($auction['url'])) ? $auction['url'] : 'club' . $auction['group_id']; ?>">
                    <img class="auction_avatar" src="<?php echo $auction['avatar_url'] ?>"/><br/>
                </a>
            </p>
        <?php endforeach; ?>
    </div>
    <div class="col-md-9 column">
        <div class="row clearfix">
            <?php $i = 0; ?>
            <?php foreach ($lots as $lot): ?>
            <?php $i++; ?>
            <div class="col-md-4 column">
                <div class="lot_header">
                    <img class="small_avatar" src="<?php echo $auctions[$lot['auction_id']]['avatar_url'] ?>">
                    <?php echo $auctions[$lot['auction_id']]['name'] ?>
                </div>
                <div align="middle">
                    <h2>

                        <img src="<?php echo $lot['attachments'][0]['url_1']; ?>"/><br/>

                    </h2>
                    <p>
                        <?php echo $lot['text']; ?><br/>
                    </p>
                    <p>
                        <a class="btn"
                           href="<?php echo base_url(); ?>lot/<?php echo $lot['id']; ?>/<?php echo $page; ?>">Подробнее
                            »</a>
                    </p>
                </div>
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
            <li><a href="<?php echo base_url(); ?>main/<?php echo $page - 1; ?>">Назад</a></li>
        <?php endif; ?>
        <li><a href="<?php echo base_url(); ?>main/<?php echo $page + 1; ?>">Дальше</a></li>
    </ul>
</nav>
</div>
</body>
</html>