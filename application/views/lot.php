<div class="row clearfix">
    <div class="col-md-12 column" align="middle">

        <?php foreach ($attachments as $attacment): ?>
            <img src="<?php echo $attacment['url_2']; ?>"/><br/>
        <?php endforeach; ?>
        <?php echo $lot[0]['text']; ?><br/>
        <div class="col-md-4 column">&nbsp;</div>
        <div class="col-md-4 column">
            Ставки:
            <table class="table table-striped">
                <?php foreach ($bets as $bet): ?>
                    <tr align="middle">
                        <td><?php echo $bet['text']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <!--tr><td>&nbsp;</td></tr-->
            </table>
            <p>
                <a class="btn btn-primary btn-large"
                   href="http://vk.com/<?php echo $auction[0]['url'] . '?w=wall-' . $auction[0]['group_id'] . '_' . $lot[0]['post_id']; ?>">Перейти
                    к лоту</a>
                <a class="btn btn-primary btn-large" href="<?php echo base_url() . 'main/' . $page; ?>">Назад</a>
            </p>
        </div>
        <div class="col-md-4 column">&nbsp;</div>


    </div>
</div>
