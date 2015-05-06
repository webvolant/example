<?php

class AdminArticleController extends Controller {

    public function add()
    {
        $specialities = Speciality::all()->lists('specialisation', 'id');//->select('name', 'email')
        return View::make('admin.article.add', array('specialities'=>$specialities));
    }

    public function delete($id)
    {
        $user = Article::find($id);
        $user->delete();
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("article/index");
    }

    public function edit($id)
    {
        $specialities = Speciality::all()->lists('specialisation', 'id');
        $user = Article::find($id);

        //CRM save - before data
        $json = json_encode($user);
        $json = json_decode($json, true);
        //$json['specialities'] = $mas;
        $j = json_encode($json, true);
        Session::put('j_before', $j);

        return View::make('admin.article.edit',array(
            'user'=>$user,
            'specialities'=>$specialities,
            //'specialities_current'=>$mas,
            //'map'=>$map,
        ));
    }

    public function index()
    {
        $users = new Article();
        $users = $users->all();
        return View::make('admin.article.list',array('users'=>$users));
    }


}