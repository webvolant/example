<?php

class DoctorController extends Controller {

    public function index(){
        return View::make('front.doctor.list');
    }
/*
    public function sort(){
        return View::make('front.doctor.list');
    }
*/
    //все врачи что есть в базе
    public function doctors(){
        $order = Input::get('order');
        $direction = Input::get('direction');
        //var_dump(\Route::current()->parameter('spec'));

        //Input::get('krit2')

        //die();
        if (\Route::current()->parameter('spec')!=null){
            if ( Input::get('order') != null && Input::get('direction') != null ){

                    if ( Input::get('deti') == true && Input::get('home') == true){
                        $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                        ->whereRole('doctor')->whereStatus(1)
                        ->where('det_doctor','=','1')
                        ->where('viesd_na_dom','=','1')
                        ->orderByRaw("ABS($order) $direction")
                        ->paginate(Helper::getPagesCount());
                        return View::make('front.doctor.list', array('users'=>$users));
                    }
                    elseif ( Input::get('deti') == true ){
                        $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                            ->whereRole('doctor')->whereStatus(1)
                            ->where('det_doctor','=','1')
                            ->orderByRaw("ABS($order) $direction")
                            ->paginate(Helper::getPagesCount());
                        return View::make('front.doctor.list', array('users'=>$users));
                    }
                    elseif ( Input::get('home') == true ){
                        $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                            ->whereRole('doctor')->whereStatus(1)
                            ->where('viesd_na_dom','=','1')
                            ->orderByRaw("ABS($order) $direction")
                            ->paginate(Helper::getPagesCount());
                        return View::make('front.doctor.list', array('users'=>$users));
                    }

                $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                    ->whereRole('doctor')->whereStatus(1)
                    //User::whereHas(
                    //'specialities', function($q){
                    //    $q->where('speciality_id', \Route::current()->parameter('spec'));
                   // }
                    ->orderByRaw("ABS($order) $direction")
                ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));

            } elseif ( Input::get('order') == null && Input::get('direction') == null ){
                if ( Input::get('deti') == true && Input::get('home') == true){
                $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                    ->whereRole('doctor')->whereStatus(1)
                    ->where('det_doctor','=','1')
                    ->where('viesd_na_dom','=','1')
                    ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
                }
                elseif ( Input::get('deti') == true ){
                    $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                        ->whereRole('doctor')->whereStatus(1)
                        ->where('det_doctor','=','1')
                        ->paginate(Helper::getPagesCount());
                    return View::make('front.doctor.list', array('users'=>$users));
                }
                elseif ( Input::get('home') == true ){
                    $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                        ->whereRole('doctor')->whereStatus(1)
                        ->where('viesd_na_dom','=','1')
                        ->paginate(Helper::getPagesCount());
                    return View::make('front.doctor.list', array('users'=>$users));
                }
                else{
                    $users = Speciality::find(\Route::current()->parameter('spec'))->Users()
                        ->whereRole('doctor')->whereStatus(1)
                        ->paginate(Helper::getPagesCount());
                   // var_dump($users);
                    return View::make('front.doctor.list', array('users'=>$users));
                }
            }

        }











        //без специализации
        if ( Input::get('order') != null && Input::get('direction') != null ){

            if ( Input::get('deti') == true && Input::get('home') == true){
                $users = User::whereRole('doctor')->whereStatus(1)
                    ->where('det_doctor','=','1')
                    ->where('viesd_na_dom','=','1')
                    ->orderByRaw("ABS($order) $direction")
                    ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
            }
            elseif ( Input::get('deti') == true ){
                $users = User::whereRole('doctor')->whereStatus(1)
                    ->where('det_doctor','=','1')
                    ->orderByRaw("ABS($order) $direction")
                    ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
            }
            elseif ( Input::get('home') == true ){
                $users = User::whereRole('doctor')->whereStatus(1)
                    ->where('viesd_na_dom','=','1')
                    ->orderByRaw("ABS($order) $direction")
                    ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
            }

            $users = User::whereRole('doctor')->whereStatus(1)
                ->orderByRaw("ABS($order) $direction")
                ->paginate(Helper::getPagesCount());
            return View::make('front.doctor.list', array('users'=>$users));

        } elseif ( Input::get('order') == null && Input::get('direction') == null ){
            if ( Input::get('deti') == true && Input::get('home') == true){
                $users = User::whereRole('doctor')->whereStatus(1)
                    ->where('det_doctor','=','1')
                    ->where('viesd_na_dom','=','1')
                    ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
            }
            elseif ( Input::get('deti') == true ){
                $users = User::whereRole('doctor')->whereStatus(1)
                    ->where('det_doctor','=','1')
                    ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
            }
            elseif ( Input::get('home') == true ){
                $users = User::whereRole('doctor')->whereStatus(1)
                    ->where('viesd_na_dom','=','1')
                    ->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
            }
            else{
                $users = User::whereRole('doctor')->whereStatus(1)->paginate(Helper::getPagesCount());
                return View::make('front.doctor.list', array('users'=>$users));
            }
        }
/*
        $users = User::whereRole('doctor')->whereStatus(1)->get();
        //$users = Helper::findInCollection($users,'det_doctor',1);
        //$users->paginate(1);
        $paginate = Paginator::make($users->toArray(), $users->count(), 1);
        //var_dump($users);
        return View::make('front.doctor.list', array('users'=>$users,'paginate'=>$paginate));*/

    }

    //Доктор детализированное инфо
    public function detail($link)
    {
        $user = User::where('link', '=', $link)->firstOrFail();
        $kliniks = $user->Kliniks()->get();//has('Users','=',1)->get();

        $mm = Helper::location($user->klinika_name);


        $config['center'] = "$mm->lat,$mm->lng";
        $config['zoom'] = 15;
        $config['cluster'] = TRUE;
        Gmaps::initialize($config);

        $marker = array();
        $marker['position'] = "$mm->lat,$mm->lng";
        Gmaps::add_marker($marker);

        foreach ($kliniks as $item){
            $mm = Helper::location($item->address);
            $marker = array();
            $marker['position'] = "$mm->lat,$mm->lng";
            Gmaps::add_marker($marker);
        }



        $map = Gmaps::create_map();

        $otzivi = Otziv::where('doctor_id','=',$user->id)->where('status','=',1)->take(Helper::reviews_count())->get();
        $count_otzivi = Otziv::where('doctor_id','=',$user->id)->count();

        return View::make('front.doctor.detail', array('user' => $user,'map' => $map,'otzivi' => $otzivi,'count_otzivi'=>$count_otzivi,'kliniks'=>$kliniks));
    }



}
