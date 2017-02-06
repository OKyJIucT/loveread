<?php
/**
 * Created by PhpStorm.
 * User: Kohone
 * Date: 03.02.2017
 * Time: 9:54
 */

include 'phpQuery/phpQuery.php';

/**
 * Парсим страницу
 * @param $url
 * @return mixed
 */
class Helper
{
    public static function parseUrl($url)
    {
        $DOM = file_get_contents($url);
        ($url);

        $document = \phpQuery::newDocument($DOM);

        $title = $document->find('h2');
        $title = strip_tags($title);

        $content = $document->find('div.MsoNormal');
        $content = preg_replace('/style=\\"[^\\"]*\\"/', '', $content);
        $content = strip_tags($content, '<p><div>');

        $last_detect = $document->find('span:contains("Вперед")');

        // определяем, последняя ли сейчас страница
        $last_page = false;
        if (sizeof($last_detect) > 0) {
            $last_page = true;
        }

        $navigation = $document->find('.tb_read_book .navigation a');

        $pages = [];
        foreach ($navigation as $i => $el) {
            $pq = pq($el); // Это аналог $ в jQuery

            $url = $pq->attr('href');

            list($trash, $page) = explode('&', $url);
            $page = str_replace('p=', '', $page);

            $pages[$i] = $page;
        }

        // если текущая страница последняя - общее количество = последняя активная + 1
        if ($last_page) {
            $i = sizeof($pages);

            $count = $pages[($i - 1)] + 1;
        } else {

            // если не последняя - берем индекс предпоследней ссылки в навигации
            //она и будет последней страницей

            $i = sizeof($pages);
            $count = $pages[($i - 2)];
        }

//        $content = iconv("windows-1251", "utf-8", $content);
//        $title = iconv("windows-1251", "utf-8", $title);

        $result = [
            'content' => $content,
            'title' => $title,
            'last_page' => $last_page,
            'count' => $count
        ];

        return $result;
    }


    public static function dump($data, $exit = false)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        if ($exit) {
            exit;
        }
    }
}