<?php

include 'Helper.php';

// id книги
$id = $_GET['id'];

// страница
$p = $_GET['p'] ? $_GET['p'] : 1;

$url = 'http://loveread.ec/read_book.php?id=' . $id . '&p=' . $p;

$data = Helper::parseUrl($url);

// для первой страницы
if ($p == 1) {

    $prev_href = '';
    $next_href = 'read_book.php?id=' . $id . '&p=' . ($p + 1);
    $prev_class = 'disabled';
    $next_class = '';

} elseif ($p == $data['count']) { // для последней страницы

    $prev_href = 'read_book.php?id=' . $id . '&p=' . ($p - 1);
    $next_href = '';
    $prev_class = '';
    $next_class = 'disabled';

} else { // для всех остальных

    $prev_href = 'read_book.php?id=' . $id . '&p=' . ($p - 1);
    $next_href = 'read_book.php?id=' . $id . '&p=' . ($p + 1);
    $prev_class = '';
    $next_class = '';

}

if ($p > $data['count']) {
    $data['content'] = '<h1>Выбранной страницы не существует</h1>';
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="windows-1251">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $data['title']; ?></title>
        <link rel="stylesheet" href="https://yastatic.net/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <!-- Custom styles for this template -->
        <link href="style.css?v=7" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="header clearfix">
                <a href="<?= $url; ?>"<h4><?= $data['title']; ?></h4></a>
            </div>
            <div class="pull-left"><strong>Страница <?= $_GET['p']; ?> из <?= $data['count']; ?></strong></div>
            <form class="form-inline pull-right" action="/read_book.php?id=60285&amp;p=46" method="get">
                <div class="form-group">
                    <div class="input-group pull-left mr8">
                        <input type="text" class="form-control" placeholder="Страница" name="p" style="width: 100px;">
                    </div>
                    <input type="hidden" name="id" value="<?= $id; ?>"/>
                    <button type="submit" class="btn btn-default">Перейти</button>
                </div>
            </form>
            <div class="clearfix"></div>
            <div class="row marketing">
                <div class="col-md-12">
                    <?= $data['content']; ?>
                </div>
            </div>
            <a href="<?= $prev_href; ?>" class="btn btn-default btn-lg col-xs-12 mb20 <?= $prev_class; ?>">Назад</a>
            <a href="<?= $next_href; ?>" class="btn btn-default btn-lg col-xs-12 mb20 <?= $next_class; ?>">Вперед</a>
            <footer class="footer">
                <div class="pull-left"><strong>Страница <?= $_GET['p']; ?> из <?= $data['count']; ?></strong></div>
                <form class="form-inline pull-right" action="/read_book.php?id=60285&amp;p=46" method="get">
                    <div class="form-group">
                        <div class="input-group pull-left mr8">
                            <input type="text" class="form-control" placeholder="Страница" name="p" style="width: 100px;">
                        </div>
                        <input type="hidden" name="id" value="<?= $id; ?>"/>
                        <button type="submit" class="btn btn-default">Перейти</button>
                    </div>
                </form>
            </footer>
        </div> <!-- /container -->
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript"> (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter42549929 = new Ya.Metrika({
                            id: 42549929,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true
                        });
                    } catch (e) {
                    }
                });
                var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
                    n.parentNode.insertBefore(s, n);
                };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";
                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks"); </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/42549929" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript> <!-- /Yandex.Metrika counter -->
    </body>
</html>