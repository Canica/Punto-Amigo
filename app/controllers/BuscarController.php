<?php

class BuscarController extends BaseController {

	public function buscar()
	{
		$data = Request::all();

		$keyword = $data['keyword'];
		$min = $data['min'];
		$max = $data['max'];

		$validation = Validator::make(
		    array(
		        'keyword' => Input::get( 'keyword' ),
		        'min' => Input::get( 'min' ),
		        'max' => Input::get( 'max' ),
		    ),
		    array(
		        'keyword' => array( 'required'),
		        'min' => array( 'required'),
		        'max' => array( 'required'),
		    )
		);
		 
		if ( $validation->fails() ) {
		    $errors = $validation->messages();
		    return Redirect::back()->withErrors($errors)->withInput();
		}

		$productos = Productos::whereBetween('costo', [$min, $max])->where('titulo', 'LIKE', '%'.$keyword.'%')->paginate(100);

		$categoryfilter = $this->categoryFilter();
        $resultado = 'Resultados para la palabara <b>'.$keyword.'</b> entre <b>'.$min.'</b> y <b>'.$max.'</b> puntos.';

        $products = Response::json($productos);
        $products = preg_replace('/HTTP(.*)GMT/s',"",$products);

        return View::make('ecommerce.search', compact('categoryfilter', 'categoria', 'products', 'resultado'));
	}

	 //Category Filter
    public function categoryFilter(){

        $recomendados = Productos::take(4)->skip(4)->orderByRaw("RAND()")->get();
        $categorias = Categorias::all();

        $categoryfilter = View::make('ecommerce.modulos.categoryfilter', compact('categorias', 'recomendados'));

        return $categoryfilter;
    }


}
