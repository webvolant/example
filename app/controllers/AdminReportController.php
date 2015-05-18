<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 15.05.15
 * Time: 1:17
 */

class AdminReportController extends Controller {

    public function events()
    {
        if (Input::get('t_begin')){
            $t_begin = DateTime::createFromFormat('d.m.Y H:i', Input::get('t_begin'));
            $t_begin = $t_begin->format('U');
        }

        if (Input::get('t_end')){
            $t_end = DateTime::createFromFormat('d.m.Y H:i', Input::get('t_end'));
            $t_end = $t_end->format('U');
        }

        if (Input::get('type')==0){
            $events = new \Illuminate\Database\Eloquent\Collection;
            $seconds = date('U', time());
            $eventers = Eventer::where('flag','!=',3)->where('date_end','!=','')->get();
            foreach ($eventers as $i):
                $object = DateTime::createFromFormat('d.m.Y H:i', $i->date_end);
                $object_seconds = $object->format('U');
                $last_time = (($object_seconds - $seconds)/60);
                if (($last_time <= Helper::latestOrderTime()) && ($last_time >= Helper::latestOrderTime2())){
                    if ($events->count()==0 || !Helper::existsInCollection($events,'id',$i->id)){
                        $temp = Eventer::where('id','=',$i->id)->first();
                        //var_dump($temp);
                        if (Input::get('t_begin') && Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin) && intval($temp->created_at->format('U')) < intval($t_end))
                                //var_dump(intval($temp->created_at->format('U')) > intval($t_begin));
                                $events->add($temp);
                        }
                        elseif (Input::get('t_begin')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin))
                                $events->add($temp);
                        }
                        elseif (Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) < intval($t_end))
                                $events->add($temp);
                        }
                        else{
                            $events->add($temp);
                        }
                    }
                }
            endforeach;
            return View::make('admin.report.events',array('events'=>$events))->withInput();
        }

        if (Input::get('type')==1){
            $events = new \Illuminate\Database\Eloquent\Collection;
            $seconds = date('U', time());
            $eventers = Eventer::where('flag','!=',3)->where('date_end','!=','')->get();
            foreach ($eventers as $i):
                $object = DateTime::createFromFormat('d.m.Y H:i', $i->date_end);
                $object_seconds = $object->format('U');
                $last_time = (($object_seconds - $seconds)/60);
                if (($last_time <= Helper::latestOrderTime()) && ($last_time >= Helper::latestOrderTime2())){
                    if ($events->count()==0 || !Helper::existsInCollection($events,'id',$i->id)){
                        $temp = Eventer::where('id','=',$i->id)->first();
                        //var_dump($temp);
                        if (Input::get('t_begin') && Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin) && intval($temp->created_at->format('U')) < intval($t_end))
                                //var_dump(intval($temp->created_at->format('U')) > intval($t_begin));
                                $events->add($temp);
                        }
                        elseif (Input::get('t_begin')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin))
                                $events->add($temp);
                        }
                        elseif (Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) < intval($t_end))
                                $events->add($temp);
                        }
                        else{
                            $events->add($temp);
                        }
                    }
                }
            endforeach;
            return View::make('admin.report.events',array('events'=>$events))->withInput();
        }

    }


    public function orders()
    {
        if (Input::get('t_begin')){
            $t_begin = DateTime::createFromFormat('d.m.Y H:i', Input::get('t_begin'));
            $t_begin = $t_begin->format('U');
        }

        if (Input::get('t_end')){
            $t_end = DateTime::createFromFormat('d.m.Y H:i', Input::get('t_end'));
            $t_end = $t_end->format('U');
        }

        if (Input::get('type')==0){
            $orders = new \Illuminate\Database\Eloquent\Collection;
            $seconds = date('U', time());
            $eventers = Eventer::where('flag','!=',3)->where('date_end','!=','')->get();
            foreach ($eventers as $i):
                $object = DateTime::createFromFormat('d.m.Y H:i', $i->date_end);
                $object_seconds = $object->format('U');
                $last_time = (($object_seconds - $seconds)/60);
                if (($last_time <= Helper::orderTime()) && ($last_time >= Helper::latestOrderTime())){
                    if ($orders->count()==0 || !Helper::existsInCollection($orders,'id',$i->order_id)){

                        $temp = Order::where('id','=',$i->order_id)->with('events')->first();

                        if (Input::get('t_begin') && Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin) && intval($temp->created_at->format('U')) < intval($t_end))
                                //var_dump(intval($temp->created_at->format('U')) > intval($t_begin));
                                $orders->add($temp);
                        }
                        elseif (Input::get('t_begin')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin))
                                $orders->add($temp);
                        }
                        elseif (Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) < intval($t_end))
                                $orders->add($temp);
                        }
                        else{
                            $orders->add($temp);
                        }
                    }
                }
            endforeach;
            return View::make('admin.report.orders',array('orders'=>$orders));
        }
        if (Input::get('type')==1){
            $orders = new \Illuminate\Database\Eloquent\Collection;
            $seconds = date('U', time());
            $eventers = Eventer::where('flag','!=',3)->where('date_end','!=','')->get();
            foreach ($eventers as $i):
                $object = DateTime::createFromFormat('d.m.Y H:i', $i->date_end);
                $object_seconds = $object->format('U');
                $last_time = (($object_seconds - $seconds)/60);
                if (($last_time <= Helper::latestOrderTime()) && ($last_time >= Helper::latestOrderTime2())){
                    if ($orders->count()==0 || !Helper::existsInCollection($orders,'id',$i->order_id)){
                        $temp = Order::where('id','=',$i->order_id)->with('events')->first();
                        //var_dump($temp);
                        if (Input::get('t_begin') && Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin) && intval($temp->created_at->format('U')) < intval($t_end))
                                //var_dump(intval($temp->created_at->format('U')) > intval($t_begin));
                                $orders->add($temp);
                        }
                        elseif (Input::get('t_begin')){
                            if (intval($temp->created_at->format('U')) > intval($t_begin))
                                $orders->add($temp);
                        }
                        elseif (Input::get('t_end')){
                            if (intval($temp->created_at->format('U')) < intval($t_end))
                                $orders->add($temp);
                        }
                        else{
                            $orders->add($temp);
                        }
                    }
                }
            endforeach;
            return View::make('admin.report.orders',array('orders'=>$orders))->withInput();
        }

    }


}