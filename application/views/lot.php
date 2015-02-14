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
                                <tr align="middle"><td><?php echo $bet['text']; ?></td></tr>
                            <?php endforeach; ?>
                            <!--tr><td>&nbsp;</td></tr-->
                        </table>
                        <p>
                            <a class="btn btn-primary btn-large" href="#">Перейти к лоту</a>
                            <a class="btn btn-primary btn-large" href="#">Назад</a>
                        </p>
                    </div>
                    <div class="col-md-4 column">&nbsp;</div>


                </div>
            </div>
        </div>
    </body>
</html>