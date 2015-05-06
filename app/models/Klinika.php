<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Klinika extends Eloquent {

	protected $table = 'kliniks';

    public function crms()
    {
        return $this->hasMany('Crm');
    }


    public function Users()
    {
        return $this->belongsToMany('User', 'user_kliniks',  'user_id', 'klinik_id' );
        //return $this->belongsToMany('Profession', 'doctor_professions', 'doctor_id', 'profession_id')->withPivot('doctor_got_professions');
    }

    public function Tests()
    {
        return $this->belongsToMany('Test', 'klinika_tests', 'klinik_id', 'test_id')->withPivot('price');
        //return $this->belongsToMany('Profession', 'doctor_professions', 'doctor_id', 'profession_id')->withPivot('doctor_got_professions');
    }






    //Получение всех клиник
    public static function getKliniks(){
        $result = Cache::remember('getKliniks', Helper::cacheTime(), function () {
            return Klinika::all();
        });
        return $result;
    }

    //Получение клиник по специальности
    public static function getKliniksBySpecialisationsCount($id){
        $users = User::whereHas(
            'specialities', function($q) use ($id){
                $q->where('speciality_id',$id);
            }
        )->get();
        foreach($users as $i)
            $users = $i->Kliniks()
                ->count();
        return $users;
    }

    public static function getSpecialisations($id){
        $kl = Klinika::find($id);
        $temp = array();
        $result = Cache::remember('getKliniks', Helper::cacheTime(), function() use ($kl, $temp) {
            foreach ( $kl->Users as $key => $sp)
            {
                foreach ( $sp->Specialities as $key => $sp){
                    array_push($temp, $sp->specialisation);
                }
                //die();
            }
            return array_unique($temp);
        });
        //var_dump(array_unique($temp));
        //die();
        return $result;

    }

    public static function getSpecialities($id){
        $kl = Klinika::find($id);
        $temp = array();
        $result = Cache::remember('getKliniks', Helper::cacheTime(), function() use ($kl, $temp) {
            foreach ( $kl->Users as $key => $sp)
            {
                foreach ( $sp->Specialities as $key => $sp){
                    array_push($temp, $sp->name);
                }
                //die();
            }
            return array_unique($temp);
        });
        //var_dump(array_unique($temp));
        //die();
        return $result;

    }





}
