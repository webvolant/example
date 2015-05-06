<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 9:28
 */

class IllnessController extends Controller{

    public function library(){
        $illness = Illness::orderBy('name', 'ASC')->get();

        return View::make('front.illness.library',array(
            'illness' => $illness,
        ));
    }

    public function index($link){

        //var_dump($link);
        //die();
        $user = Speciality::where('link','=',$link)->get();
        $last_articles = Illness::where('speciality_id','=',$link)->where('status','=',1)->get();
        //var_dump($last_articles);
        //die();



        //foreach($user as $item)
                     //echo $item->description;
        //die();

        return View::make('front.illness.list',array(
            'last_articles' => $last_articles,
            //'specialisations2' => $specialisations,
            //'specialities_current'=>$mas,
            'user'=>$user,
        ));
    }

    public function detail($link){
        $article = Illness::where('link','=',$link)->firstOrFail();
        return View::make('front.illness.detail',array(
            'article' => $article,
        ));
    }

}