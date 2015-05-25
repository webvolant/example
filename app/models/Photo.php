<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 9:29
 */


class Photo extends Eloquent {


    protected $table = 'photos';



    //Получение всех фотографий клиники
    public static function getPhotos($id){
        //Session::put('klinik_id',$id);
        //$result = Cache::remember('getPhotos', Helper::cacheTime(), function () {
        return Photo::where('klinik_id','=',$id)->get();
        //});
        //return $result;
    }




}