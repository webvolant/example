<?php

class KlinikaController extends Controller {

    /*public function index(){
        return View::make('front.klinika.list');
    }*/

    //все клиники что есть в базе
    public function all(){
        if (\Route::current()->parameter('spec')!=null){
            //клиники по айди специальности
            if ( Input::get('order') != null && Input::get('direction') != null ){
                    $users = User::whereHas(
                        'specialities', function($q){
                            $q->where('speciality_id', \Route::current()->parameter('spec'));
                        }
                    )->get();
                    foreach($users as $i)
                        $users = $i->Kliniks()->where('type','=',0)
                            ->orderBy(Input::get('order'),Input::get('direction'))
                            ->paginate(Helper::getPagesCount());
                    return View::make('front.klinika.list', array('users'=>$users));

            } elseif ( Input::get('order') == null && Input::get('direction') == null ){
                $users = User::whereHas(
                    'specialities', function($q){
                        $q->where('speciality_id', \Route::current()->parameter('spec'));
                    }
                )->get();
                foreach($users as $i)
                    $users = $i->Kliniks()->where('type','=',0)
                        ->paginate(Helper::getPagesCount());
                return View::make('front.klinika.list', array('users'=>$users));
            }


            $users = User::whereHas(
                'specialities', function($q){
                    $q->where('speciality_id', \Route::current()->parameter('spec'));
                }
            )->get();
            if (!$users->exists())
                $users = Klinika::where('type','=',0)->paginate(Helper::getPagesCount());
            return View::make('front.klinika.list', array('users'=>$users));


        } else { //Клиники без специализации
            if ( Input::get('order') != null && Input::get('direction') != null ){
                        $users = Klinika::whereStatus(1)->where('type','=',0)
                        ->orderBy(Input::get('order'),Input::get('direction'))
                        ->paginate(Helper::getPagesCount());
                        return View::make('front.klinika.list', array('users'=>$users));
            } elseif ( Input::get('order') == null && Input::get('direction') == null ){
                     $users = Klinika::whereStatus(1)->where('type','=',0)
                    ->paginate(Helper::getPagesCount());
                    return View::make('front.klinika.list', array('users'=>$users));
            }



        }


/*
        $users = User::whereHas(
            'specialities', function($q){
                $q->where('speciality_id', 1);
            }
        )->get();
        var_dump($users->count());
        foreach($users as $i)
            $users = $i->Kliniks()->orderBy('rating')->paginate(3);
        var_dump($users->count());
        //$users = Klinika::getKliniks();

        //$users = Klinika::with('Users')

        return View::make('front.klinika.list', array('users'=>$users));*/
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

        $marker = array();
        $marker['position'] = "$mm->lat,$mm->lng";
        Gmaps::add_marker($marker);

        $map = Gmaps::create_map();


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
