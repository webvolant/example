<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Klinika extends Eloquent {


    protected $softDelete = true;
	protected $table = 'kliniks';

    public function crms()
    {
        return $this->hasMany('Crm');
    }


    public function Users()
    {
        return $this->belongsToMany('User', 'user_kliniks',  'klinik_id','user_id' );
    }

    public function Tests()
    {
        return $this->belongsToMany('Test', 'klinika_tests', 'klinik_id', 'test_id')->withPivot('price');
    }



    public static function getTestsForKlinik($kl){
        $tests = $kl->Tests()->withPivot('price')->orderBy('lft')->get();
        //$tests = $kl->Tests()->withPivot('price')->orderBy('lft')->getNestedList();
        $cap = "";
        $parent_prev = "";
        foreach($tests as $test){
            if ($test->name == 'root')
                $parent = 'Нет родителя';
            else
                $parent = $test->parent()->first()->name;
            if ($parent_prev != $parent){
                $cap .= '<p>'.$parent.'</p>';
                $parent_prev = $parent;
            }
            $cap .='<p class="margin-left20">'.$test->name.'<a id='. $test->id .' class="test-delete" href='.' class="margin-left20">'.' - удалить'.'</a>'.'</p>';
        }
        return $cap;
    }


    //Получение всех клиник
    public static function getKliniks(){
        $result = Cache::remember('getKliniks', Helper::cacheTime(), function () {
            return Klinika::all();
        });
        return $result;
    }

    //Получение числа клиник по специальности
    public static function getKliniksBySpecialisationsCount($id){
        $kls = User::whereHas(
            'specialities', function($q) use ($id) {
                $q->where('speciality_id', $id);
            }
        )->get();
        $docIds = array_pluck($kls,"id");
        $kliniks = DB::table('kliniks')->distinct()
            ->join('user_kliniks', function($join){
                $join->on('user_kliniks.klinik_id','=','kliniks.id');
            })
            ->whereIn('user_id',$docIds)
            ->where('kliniks.type',0)->orWhere('kliniks.type','=',"")
            ->groupBy('link')
            ->get();
        //var_dump(count($kliniks));
        return count($kliniks);
    }

    //Получение клиник по специальности
    public static function getSpecialisations($id){
        $result = Cache::remember('getKliniks'+$id, Helper::cacheTime(), function() use ($id) {
            $temp = array();
            $kl = Klinika::find($id);
            foreach ( $kl->Users as $key => $sp)
            {
                foreach ( $sp->Specialities as $key => $sp){
                    array_push($temp, $sp->specialisation);
                }
            }
            return array_unique($temp);
        });
        return $result;
    }

    public static function getSpecialities($id){
        $result = Cache::remember('getKliniks', Helper::cacheTime(), function() use ($id) {
            $kl = Klinika::find($id);
            $temp = array();
            foreach ( $kl->Users as $key => $sp)
            {
                foreach ( $sp->Specialities as $key => $sp){
                    array_push($temp, $sp->name);
                }
                //die();
            }
            return array_unique($temp);
        });
        return $result;

    }

    public static function getType($id){
        if ($id==0){
            $res = 'Клиника';
        }
        elseif($id==1){
            $res = 'Диагностический центр';
        }
        return $res;
    }





}
