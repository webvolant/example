<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 9:28
 */

class ArticleController extends Controller{

    public function library(){

        $specialisations = Speciality::all();
        $last_articles = Article::all()->take(15)->reverse();

        return View::make('front.article.library',array(
            'last_articles' => $last_articles,
            'specialisations2' => $specialisations,
            //'specialities_current'=>$mas,
            //'map'=>$map,
        ));
    }

    public function index($link){

        //var_dump($link);
        //die();
        $user = Speciality::where('specialisation_alias','=',$link)->firstOrFail();
        $temp = $user->id;
        //var_dump($user->id);
        //die();
        $last_articles = Article::where('speciality_id','=',$temp)->where('status','=',1)->get();
        //var_dump($last_articles);
        //die();

        //foreach($user as $item)
                     //echo $item->description;
        //die();

        $illness = Illness::where('speciality_id','=',$temp)->where('status','=',1)->get();

        return View::make('front.article.list',array(
            'last_articles' => $last_articles,
            //'specialisations2' => $specialisations,
            'illness'=>$illness,
            'user'=>$user,
        ));
    }

    public function detail($link){
        $article = Article::where('link','=',$link)->firstOrFail();
        return View::make('front.article.detail',array(
            'article' => $article,
        ));
    }

}