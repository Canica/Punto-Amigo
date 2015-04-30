<?php namespace Componentes\Comentarios;

use Illuminate\View\Factory as View;

class CommentBuilder {

    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function comments($comments, $id, $rate){
        
        return $this->view->make('ecommerce.modulos.comments', compact('comments', 'id', 'rate'));
    }

}