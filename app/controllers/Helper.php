<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 07.04.15
 * Time: 12:01
 */


class Helper extends Controller{

    public static function getUrlWithParams(){
        $url = Request::url();
        $params = "";
        foreach (Input::all() as $key => $item)
            $params .= '&'.$key.'='.$item;
        $url = Request::url().'?'.$params;
        return $url;
    }

    public static function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }

    public static function alias($str) {
        // переводим в транслит
        $str = Helper::rus2translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }


    public static function russian_date($month){
        $m="";
        switch ($month){
            case 1: $m='Янв'; break;
            case 2: $m='Фев'; break;
            case 3: $m='Мар'; break;
            case 4: $m='Апр'; break;
            case 5: $m='Мая'; break;
            case 6: $m='Июн'; break;
            case 7: $m='Июл'; break;
            case 8: $m='Авг'; break;
            case 9: $m='Сен'; break;
            case 10: $m='Окт'; break;
            case 11: $m='Ноя'; break;
            case 12: $m='Дек'; break;
        }
        return $m;
    }


    public static function location($address)
    {
        $obj = null;

        if (empty($address)){
            $address = 'Бишкек';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $output = curl_exec($ch);

        if ($output !== false)
        {
            if ($location = json_decode($output))
            {
                if ($location->status == 'OK')
                    $obj = $location->results[0]->geometry->location;
            }
        }

        curl_close($ch);

        return $obj;
    }

    public static function orderTime(){
        return 180;
    }

    public static function latestOrderTime(){
        return '-60';
    }

    public static function latestOrderTime2(){
        return '-2280';
    }


    public static function cacheTime(){
        return Carbon::now()->addMinutes(120); //addMinutes(1/60);
    }

    public static function typeOfObject(){
        $mas=[0=>'Клиника',1=>'Диагностический центр'];
        return $mas;
    }

    public static function globalStatus(){
        $mas=[0=>'Новый',1=>'Обрабатывается',2=>'Завершен',3=>'Возобновлен'];
        return $mas;
    }

    public static function getStrGlobalStatus($mas){
        if ($mas==0)
            return $str = 'Новый';
        elseif ($mas==1)
            return $str = 'Обрабатывается';
        elseif ($mas==2)
            return $str = 'Завершен';
        elseif ($mas==3)
            return $str = 'Возобновлен';
    }

    public static function eventStatus(){
        $mas=[2=>'Событие не выполнено',1=>'Обращение клиента',3=>'Выполненное событие']; /*0=>'Событие ждет',1=>'Событие занято оператором'*/
        return $mas;
    }

    public static function getStrEventStatus($mas){
        if ($mas==3)
            return $str = 'Выполненное событие';
        elseif ($mas==2)
            return $str = 'Событие не выполнено';
        elseif ($mas==1)
            return $str = 'Обращение клиента'; //четвертый номер событие создано из формы
    }



    public static function status(){
        $mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return $mas;
    }

    public static function reviews_count(){
        //$mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return 1;
    }

    public static function getPagesCount(){
        //$mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return 12;
    }

    public static function getEventsCount(){
        //$mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return 15;
    }

    public static function rating(){
        //$mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return 5;
    }


    public static function existsInCollection($collection, $key, $value) {
        $flag = '';
        foreach ($collection as $item) {
            if (isset($item->$key) && $item->$key == $value)
                $flag = true;
            else
                $flag = false;
        }
        return $flag;
    }


    public static function findInCollection($collection, $key, $value) {
        $new_col = new \Illuminate\Database\Eloquent\Collection;
        foreach ($collection as $item) {
            if (isset($item->$key) && $item->$key == $value) {
                $new_col->push($item);
            }
        }
        return $new_col;
    }


    public static function title(){
        //$mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return "MY-DOC.KG - медицинский портал 'Мой доктор'.  ";
    }

    public static function description(){
        //$mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return "Сервис 'Мой доктор' предоставляет доступ к данным о врачах, практикующих в клиниках и медицинских центрах Бишкека.Вы можете легко подобрать себе нужного специалиста, используя удобные опции поиска на сайте.";
    }

    public static function keywords(){
        //$mas=[0=>'Не опубликовано',1=>'Опубликовано'];
        return "Бишкек, доктор, мой доктор, сервис поиска врачей, my-doc, mydoc, mydoctor, mydoc.kg, my-doc.kg, поиск врача, база данный врачей,медицинский портал, кыргызстан, клиника, диагностический центр, аптека, найти, поиск";
    }

/*
    public function mypaginate($perPage) {
        $pagination = App::make('paginator');
        $count = $this->count();
        $page = $pagination->getCurrentPage($count);
        $items = $this->slice(($page - 1) * $perPage, $perPage)->all();
        $pagination = $pagination->make($items, $count, $perPage);
        return $pagination;
    }
*/

}