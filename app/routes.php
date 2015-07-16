<?php



Route::get('404', function(){
    return View::make('error404',array());
});

Route::get('401', function(){
    return View::make('error401',array());
});

Route::get('500', function(){
    return View::make('error500',array());
});


Route::get('/', array('as' => '/',
    'uses' => 'HomeController@showHome'));

View::composer(array('front',
    'front.doctor.list',
    'front.klinika.list',
    'front.klinika.diaglist',
    'front.article.library',
    'front.article.list',
    'front.illness.library',
    'front.illness.list'),
    function($view)
        {
            $orders = Cache::remember('orders', Helper::cacheTime(), function()
            {
                return $orders = Order::getOrdersCount();
            });

            $docs = Cache::remember('docs', Helper::cacheTime(), function()
            {
                return $docs = User::getDoctorsCount();
            });

            $ot = Cache::remember('ot', Helper::cacheTime(), function()
            {
                return $ot = Otziv::getOtzivCount();
            });

            $view->with('orders', $orders);
            $view->with('docs', $docs);
            $view->with('ot', $ot);

            $search_mas = [0=>"По специальности",1=>"По специализации",2=>"По исследованию",3=>"По заболеванию"];

            $specialities = Cache::remember('specialities', Helper::cacheTime(), function()
            {
                return $specialities = Speciality::orderBy('name','asc')->lists('name', 'id');
            });

            $specialisations = Cache::remember('specialisations', Helper::cacheTime(), function()
            {
                return $specialisations = Speciality::orderBy('specialisation','asc')->lists('specialisation', 'id');
            });

            $view->with('search1', $search_mas); //массив критериев поиска
            $view->with('specialities', $specialities); //массив специальностей
            $view->with('specialisations', $specialisations); //массив специализаций


            $sidebar_libraries = '<div class="pull-right col-xs-12 col-sm-12 col-md-2">
                <div class="sidebar_item">
                    <p><a href='.URL::route('library').'>Медицинская библиотека</a></p>
                    <p>
                        Полезные статьи о заболеваниях, современных методах лечения и диагностиках.
                    </p>
                </div>

                <div class="sidebar_item">
                    <p><a href='.URL::to('diagnostica/centers').'>Диагностические центры</a></p>
                    <p>
                        Вам нужно провести диагностику или обследование? Специализированный портал поможет подобрать диагностический центр рядом с домом.
                    </p>
                </div>

                <div class="sidebar_item">
                    <p><a href='.URL::route('illness').'>Справочник заболеваний</a></p>
                    <p>
                        Медицинский справочник болезней от А до Я.
                    </p>
                </div>
            </div>';
            $view->with('sidebar_libraries', $sidebar_libraries);


             $specialisations_for_list = Cache::remember('specialisations_for_list', Helper::cacheTime(), function()
             {
                 return Speciality::orderBy('specialisation','asc')->get();
             });


            $specialisationsWithIndex = Cache::remember('specialisationsWithIndex', Helper::cacheTime(), function() use ($specialisations_for_list)
            {
                $spec_temp = '';
                foreach($specialisations_for_list as $key => $item){
                    $spec_temp.='<h5><li><a href='.URL::route('clinics/all', array($item->id)).'>'. $item->specialisation .'</a>'.
                            '<div class="pull-right">'.Klinika::getKliniksBySpecialisationsCount($item->id).
                            '</div></li></h5>';
                }
                return $spec_temp;
            });
            $view->with('specialisationsWithIndex', $specialisationsWithIndex);


            $illness = Cache::remember('illness', Helper::cacheTime(), function()
            {
                return $illness = Illness::all();
            });
            $view->with('illness', $illness);


        });







foreach (File::allFiles(__DIR__ . '/routes') as $partial) {
    require_once $partial->getPathname();
}