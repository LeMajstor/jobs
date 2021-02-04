<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Verificação de URL
    protected function url_verify($string, $model, $id = '')
    {
        $slugfy = $this->slugify($string, '-');

        //Caso não tenha passado o id
        if ($id == "") {
            $url_result_verify = $model->withTrashed()->where('url', $slugfy)->get()->first();
            if (isset($url_result_verify)) {
                $return = false;
                $i = 1;
                do {
                    $url_new = $slugfy . '-' . $i++;
                    $url_result_verify = $model->withTrashed()->where('url', '=', $url_new)->first();
                    if (empty($url_result_verify)) {

                        $return = true;
                    }
                } while ($return == false);
                return strtolower($url_new);
                exit;
            } else {
                return strtolower($slugfy);
                exit;
            }
        } else {
            $url_result_verify = $model
                ->withTrashed()
                ->where('url', $slugfy)
                ->where('id', '<>', $id)
                ->first();

            if (isset($url_result_verify)) {

                $return = false;
                $i = 1;
                do {
                    $url_new = $slugfy . '-' . $i++;
                    $url_result_verify = $model
                        ->withTrashed()
                        ->where('url', $url_new)
                        ->where('id', '<>', $id)
                        ->first();
                    if (!isset($url_result_verify->url) or $url_result_verify->url == "") {
                        $return = true;
                    }
                } while ($return == false);
                return strtolower($url_new);
                exit;
            } else {
                return strtolower($slugfy);
                exit;
            }
        }
    }

    //URL Amigável
    public static function slugify($text)
    {
        $string = preg_replace('/[\t\n]/', ' ', $text);
        $string = preg_replace('/\s{2,}/', ' ', $string);
        $list = array(
            'Š' => 'S',
            'š' => 's',
            'Đ' => 'Dj',
            'đ' => 'dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'Č' => 'C',
            'č' => 'c',
            'Ć' => 'C',
            'ć' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            '/' => '-',
            ' ' => '-',
            '.' => '-',
            ',' => '',
            '?' => ''
        );

        $string = strtr($string, $list);
        $string = preg_replace('/-{2,}/', '-', $string);
        $string = strtolower($string);

        return $string;
    }
}
