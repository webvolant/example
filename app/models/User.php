<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    protected $softDelete = true;

	protected $table = 'users';

    protected $fillable = array('fio', 'phone', 'doma' , 'klinika_name', 'dogovor', 'email', 'password', 'role');

	protected $hidden = array('password', 'remember_token');




    /****** СВЯЗИ *//////////////////

    public function reviews()
    {
        return $this->has_many('Otzivi');
    }

    public function crms()
    {
        return $this->hasMany('Crm');
    }


    public function Specialities()
    {
        return $this->belongsToMany('Speciality', 'user_specialities','user_id', 'speciality_id');
        //return $this->belongsToMany('Profession', 'doctor_professions', 'doctor_id', 'profession_id')->withPivot('doctor_got_professions');
    }

    public function Kliniks()
    {
        return $this->belongsToMany('Klinika', 'user_kliniks','user_id', 'klinik_id');
        //return $this->belongsToMany('Profession', 'doctor_professions', 'doctor_id', 'profession_id')->withPivot('doctor_got_professions');
    }


    /****** ОПЕРАТОРЫ *//////////////////

    //Получение всех операторов
    public static function getOperators(){
        $result = Cache::remember('getOperators', Helper::cacheTime(), function () {
            return User::where('role','=','operator')->orWhere('role','=','admin')->get();
        });
        return $result;
    }


    /****** ДОКТОРА *//////////////////


    //Получение всех докторов по определенной специальности
    public static function getDoctorsBySpecialities($sp){
        Session::put('id',$sp);
        $result = Cache::remember("getDoctorsBySpecialities$sp", Helper::cacheTime(), function () {
            $result = User::whereHas(
                'specialities', function($q){
                    $q->where('speciality_id', Session::get('id'));
                }
            )->get();
            return $result;
        });
        return $result;
    }



    //Получение всех докторов
    public static function getDoctors(){
        $result = Cache::remember('getDoctors', Helper::cacheTime(), function () {
            return User::orderBy('experience','desc')->whereRole('doctor')->whereStatus('1')->get();
        });
        return $result;
    }

    //Получение всех докторов
    public static function getDoctorsForAdmin(){
        $result = Cache::remember('getDoctors', Helper::cacheTime(), function () {
            return User::whereRole('doctor')->get();
        });
        return $result;
    }

    //Получение числа докторов для статистики в шапке
    public static function getDoctorsCount(){
        $result = Cache::remember('getDoctorsCount', Helper::cacheTime(), function () {
            return User::whereRole('doctor')->count();
        });
        return $result;
    }

    //Получение имени
    public static function getName($id){
        $result = User::find($id);
        if ($result){
            return $result->fio;
        }
        return "Доктор не выбран";
    }









}
