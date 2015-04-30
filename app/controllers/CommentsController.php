<?php

class CommentsController extends BaseController {

    public function save()
    {
        $data = Input::all();

        $control = Comments::where('component_item_id', '=', $data['component_item_id'])->where('user_id', '=', $data['user_id'])->get();

        if($control->count() == 0){
            $comentario = new Comments;

            $comentario->user_id = $data['user_id'];
            $comentario->component_name = $data['component_name'];
            $comentario->component_item_id = $data['component_item_id'];
            $comentario->title = '';//$data['title'];
            $comentario->comment = $data['comment'];
            $comentario->rate = 0;

            $comentario->save();
        }else{

            Comments::where('component_item_id', '=', $data['component_item_id'])->where('user_id', '=', $data['user_id'])->update(array('title' => '', 'comment'=> $data['comment']));

        }

        return Redirect::back();
    }
    public function rate()
    {

        $data = Request::all();

        foreach ($data[0] as $key => $value) {
            if($key == 'rate'){
                $rate = $value;
            }else if($key == 'prod_id'){
                $prod_id = $value;
            }else if($key == 'user'){
                $user = $value;
            }
        }

        $control = Comments::where('component_item_id', '=', $prod_id)->where('user_id', '=', $user)->get();

        if($control->count() == 0){

            $comentario = new Comments;

            $comentario->user_id = $user;
            $comentario->component_name = 'productos';
            $comentario->component_item_id = $prod_id;
            $comentario->title = '';
            $comentario->comment = '';
            $comentario->rate = $rate;

            $comentario->save();

            return 'no existe';
        }else{

            Comments::where('component_item_id', '=', $prod_id)->where('user_id', '=', $user)->update(array('rate' => $rate));

            return 'existe'.$control;
        }

    }
}