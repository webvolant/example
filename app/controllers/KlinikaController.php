<?php

class KlinikaController extends Controller {

    //все клиники что есть в базе
    public function all(){
        if (\Route::current()->parameter('spec')!=null){
            //клиники по айди специальности
            if ( Input::get('order') != null && Input::get('direction') != null ){
                $kls = User::whereHas(
                    'specialities', function($q){
                        $q->where('speciality_id', \Route::current()->parameter('spec'));
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
                    ->orderBy(Input::get('order'),Input::get('direction'))
                    ->paginate(Helper::getPagesCount());
                    return View::make('front.klinika.list', array('users'=>$kliniks));

            } elseif ( Input::get('order') == null && Input::get('direction') == null ){
                $kls = User::whereHas(
                    'specialities', function($q){
                        $q->where('speciality_id', \Route::current()->parameter('spec'));
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
                    ->paginate(Helper::getPagesCount());

                  /*
                    User::whereHas(
                    'specialities', function($q){
                        $q->where('speciality_id', \Route::current()->parameter('spec'));
                    }
                )->get();
                $kliniks = new \Illuminate\Database\Eloquent\Collection;
                foreach($users as $i){

                    $klinika = $i->Kliniks()->where('type','=',0)->first();
                    if (is_object($klinika))
                        $kliniks->push($i->Kliniks()->where('type','=',0)->first());
                }

                $kliniks = Paginator::make($kliniks, 6, 1);
*/


                //$kliniks = DB::table('kliniks as k')->join('user_kliniks', 'user_kliniks.klinik_id','=','k.id')->where('k.id','=','2')->get();
                /*$kliniks = DB::table('kliniks')
                    ->join('user_kliniks', function($join){
                      $join->on('user_kliniks.klinik_id','=','kliniks.id');
                    })
                    ->join('users', function($join){
                        $join->on('users.id','=','user_kliniks.user_id');
                    })
                    ->join('user_specialities', function($join){
                        $join->on('user_specialities.user_id','=','users.id');
                    })
                    ->where('user_specialities.speciality_id','2')
                    ->distinct()
                    ->get();
*/

                return View::make('front.klinika.list', array('users'=>$kliniks));
            }
/*
            $users = User::whereHas(
                'specialities', function($q){
                    $q->where('speciality_id', \Route::current()->parameter('spec'));
                }
            )->get();

            if (!$users->exists()) */
            $kliniks = DB::table('kliniks')->distinct()
                ->join('user_kliniks', function($join){
                    $join->on('user_kliniks.klinik_id','=','kliniks.id');
                })
                ->where('kliniks.type',0)->orWhere('kliniks.type','=',"")
                ->groupBy('link')
                ->paginate(Helper::getPagesCount());
            //var_dump($kliniks);
            //die();
            return View::make('front.klinika.list', array('users'=>$kliniks));
        } else { //Клиники без специализации
            if ( Input::get('order') != null && Input::get('direction') != null ){
                    $kliniks = DB::table('kliniks')->distinct()
                    ->join('user_kliniks', function($join){
                        $join->on('user_kliniks.klinik_id','=','kliniks.id');
                    })
                    ->where('kliniks.type',0)->orWhere('kliniks.type','=',"")
                    ->orderBy(Input::get('order'),Input::get('direction'))
                    ->groupBy('link')
                    ->paginate(Helper::getPagesCount());
                    return View::make('front.klinika.list', array('users'=>$kliniks));
            } elseif ( Input::get('order') == null && Input::get('direction') == null ){
                    $kliniks = DB::table('kliniks')->distinct()
                    ->join('user_kliniks', function($join){
                        $join->on('user_kliniks.klinik_id','=','kliniks.id');
                    })
                    ->where('kliniks.type',0)->orWhere('kliniks.type','=',"")
                    ->groupBy('link')
                    ->paginate(Helper::getPagesCount());
                    return View::make('front.klinika.list', array('users'=>$kliniks));
            }
        }
    }



    //Клиника детализированное инфо
    public function detail($link)
    {
        $user = Klinika::where('link', '=', $link)->first();
        $photos = Photo::getPhotos($user->id);
        //$users = User::has('Kliniks','=',$user->id)->count();
        $users = Klinika::find($user->id)->Users()->get();
        //var_dump($users);
        //die();

        $mm = Helper::location($user->address);

        $config['center'] = "$mm->lat,$mm->lng";
        $config['zoom'] = 15;
        Gmaps::initialize($config);
        //var_dump($mm->lat,$mm->lng);
        $marker = array();
        $marker['position'] = "$mm->lat,$mm->lng";
        Gmaps::add_marker($marker);

        $map = Gmaps::create_map();
        //http://maps.googleapis.com/maps/api/geocode/output?parameters
        /*$xml = simplexml_load_file('http://maps.googleapis.com/maps/api/geocode/xml?address='.$user->address);
        $lat = $xml->result->geometry->location->lat;
        $lng = $xml->result->geometry->location->lng;
        var_dump($lat);
        var_dump($lng);*/




        //var_dump($photos);
        //die();
        return View::make('front.klinika.detail', array('user' => $user,'photos'=>$photos,'map'=>$map,'users'=>$users));
    }





    public function centers(){
        if (\Route::current()->parameter('diag') != null && \Route::current()->parameter('area') != null){
            $users = Klinika::where('status','=',1)->where('type','=',1)->whereHas('tests', function($q){
                    $q->where('link', \Route::current()->parameter('area'))->orWhere('link', \Route::current()->parameter('diag'));
                }
            )->paginate(Helper::getPagesCount());
            return View::make('front.klinika.diaglist', array('users'=>$users));
        }
        elseif (\Route::current()->parameter('diag') != null){ //для поиска по второму параметру.
            $users = Klinika::where('status','=',1)->where('type','=',1)->whereHas('tests', function($q){
                    $q->where('link', \Route::current()->parameter('diag'));
                }
            )->paginate(Helper::getPagesCount());
            return View::make('front.klinika.diaglist', array('users'=>$users));
        }
        elseif (\Route::current()->parameter('area') != null){ //для поиска по второму параметру.
            $users = Klinika::where('status','=',1)->where('type','=',1)->whereHas('tests', function($q){
                    $q->where('link', \Route::current()->parameter('area'));
                }
            )->paginate(Helper::getPagesCount());
            return View::make('front.klinika.diaglist', array('users'=>$users));
        }

        elseif (\Route::current()->parameter('diag') == null && \Route::current()->parameter('area') == null){
            $users = Klinika::where('status','=',1)->where('type','=',1)->paginate(Helper::getPagesCount());
            return View::make('front.klinika.diaglist', array('users'=>$users));
        }

    }


    //Диагностический центр детализированное инфо
    public function diagdetail($link)
    {
        $user = Klinika::where('link', '=', $link)->first();
        $photos = Photo::getPhotos($user->id);
        $users = Klinika::find($user->id)->Users()->get();

        $mm = Helper::location($user->address);

        $config['center'] = "$mm->lat,$mm->lng";
        $config['zoom'] = 15;
        Gmaps::initialize($config);

        $marker = array();
        $marker['position'] = "$mm->lat,$mm->lng";
        Gmaps::add_marker($marker);

        $map = Gmaps::create_map();


        //var_dump($photos);
        //die();
        return View::make('front.klinika.diagdetail', array('user' => $user,'photos'=>$photos,'map'=>$map,'users'=>$users));
    }



}
