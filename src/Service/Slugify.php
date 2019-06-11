<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-06-09
 * Time: 23:10
 */

namespace App\Service;

class Slugify
{
    private $character = '-';

    public function generate(string $input):string
    {
        $result = iconv( 'UTF-8', 'ASCII//TRANSLIT//IGNORE', $input);
        $result = preg_replace('%[^\w ]%', '', $result);
        $result = trim($result);
        $result = preg_replace('% +%', $this->character, $result);
        return strtolower($result);
    }
}
