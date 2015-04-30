<?php


class EcommerceController extends BaseController {
    //Categorias
    public function showCategoria($id)
    {
        $categoryfilter = $this->categoryFilter();

        $productos = Productos::where('category_id', '=', $id)->where('estado', '=', true)->paginate(12);
        $categoria = Categorias::where('id', '=', $id)->get();

        $products = Response::json($productos);
        $products = preg_replace('/HTTP(.*)GMT/s',"",$products);
        $mascanjeados = $this->mascanjeados();

        $socio = $this->getSocio();

        return View::make('ecommerce.categoria', compact('categoryfilter', 'categoria', 'products', 'mascanjeados', 'socio'));
    }
    //Paginación infinita de la categoria
    public function getJson($catid, $page){
        Paginator::setCurrentPage($page);

        $productos = Productos::where('category_id', '=', $catid)->where('estado', '=', true)->paginate(12);

        $products = Response::json($productos);
        $products = preg_replace('/HTTP(.*)GMT/s',"",$products);

        print_r($products);        
    }

    //Productos
    public function showProducto($id)
    {
        $categoryfilter = $this->categoryFilter();
        $producto = Productos::where('id', '=', $id)->get();
        $mascanjeados = $this->mascanjeados();
        $socio = $this->getSocio();

        return View::make('ecommerce.producto', compact('producto', 'categoryfilter', 'comments', 'mascanjeados', 'socio'));
    }

    //Mis pedidos
    public function showPedidos()
    {
        $user_id = Session::get('socio_id');
        $pedidos = Pedidos::where('user_id', '=', $user_id)->get();

        $productos2 = array();
        $products_id = $this->renderProductosPedidos($pedidos, 'idsP');
        $socio = $this->getSocio();

        foreach ($products_id as $prod) {
            $id = str_replace('"',"", $prod['id']);
            $producto = Productos::where('id', '=', $id)->get();
            foreach ($pedidos as $key => $value) {
                if($value->id == $prod['pedido']){
                    $productos2[$key][] = $producto[0];
                    array_unique($productos2[$key]);
                    $pedidos[$key]->productos = $productos2[$key];
                }
            }
        }

        $categoryfilter = $this->categoryFilter();

        return View::make('ecommerce.mispedidos',  compact('pedidos', 'categoryfilter', 'socio'));
    }

    //carrito con items
    public function showSummary()
    {
        $categoryfilter = $this->categoryFilter();
        $socio = $this->getSocio();

        return View::make('ecommerce.summary',  compact('categoryfilter', 'socio'));
    }

    //check out
    public function showCheckout()
    {
        $user_id = Session::get('socio_id');
        $estado = 'pendiente';
        $items2 = array();
        $quantity = array();
        $productoCO = array();

        $data = Request::all();
 
        foreach ($data['data'] as $key => $value) {
            if($key == 'totalCost'){
                $totalCost = $value;
            }else if($key == 'items'){
                $items = $value;
                foreach ($value as $item) {
                    
                    $items2[] = $item['id'];
                    $quantity[] = $item['quantity'];
                    $producto = Productos::where('id', '=', $item['id'])->get();

                    $productoCO[] = [
                        'id' => $producto[0]->id, 
                        'titulo' => $producto[0]->titulo, 
                        'costo' => $producto[0]->costo, 
                        'cantidad' => $item['quantity'], 
                        'total' => ($item['quantity'] * $producto[0]->costo), 
                        'imagen' => $producto[0]->imagen
                    ];

                    $stockactual = $producto[0]->stock;
                    $stock = $stockactual - $item['quantity'];

                    if($stock <= 0){
                        Productos::where('id', '=', $item['id'])->update(array('stock' => $stock, 'estado' => false));
                    }else{
                        Productos::where('id', '=', $item['id'])->update(array('stock' => $stock));
                    }
                    Usuario::where('id', '=', $user_id)->update(array('bloqueado' => true));
                }
            }
            
        }

        $pedido = new Pedidos;

        $pedido->user_id = $user_id;
        $items = json_encode($items2);
        $pedido->products_id = $items;
        $quantity = json_encode($quantity);
        $pedido->products_quantity = $quantity;
        $pedido->total_cost = $totalCost;
        $pedido->estado = $estado;

        $pedido->save();

        $the_id = $pedido->id;

        $barcode = url('/').'/barcode/barcode.php?text='.$the_id;
        Pedidos::where('id', '=', $the_id)->update(array('barcode' => $barcode));

        $comprobante = array('user_id' => $user_id, 'id' => $the_id, 'totalCost' => $totalCost, 'estado' => $estado);
        $resultado = array_merge((array)$comprobante, (array)$productoCO);

        $socio = $this->getSocio();

        return View::make('ecommerce.checkout', compact('resultado', 'the_id', 'barcode', 'socio'));
    }

    //PDF
    public function printPDF($id)
    {
        $productos = array();
        $pedidos = Pedidos::where('id', '=', $id)->get();
        $products_id = $this->renderProductosPedidos($pedidos, 'ids');
        $products_cant = $this->renderProductosPedidos($pedidos, 'cant');

        foreach ($products_id as $key => $id) {
            $id = str_replace('"',"", $id);
            $cant =  str_replace('"',"", $products_cant[$key]);
            $producto = Productos::where('id', '=', $id)->get();
            $producto[0]->cantidad = $cant;
            $productos[] = $producto[0];
        }
        
        $productosRender = '<table  cellpadding="5" cellspacing="3" background="#333"><tr><th background="#eee" align="center">ID del producto</th><th background="#eee" align="center">Nombre</th><th background="#eee" align="center">Cantidad</th><th background="#eee" align="center">Costo Unidad</th></tr>';
        $productosRender .= '<tbody>';
        foreach ($productos as $prod) {
            $productosRender .= '<tr><td background="#fff" align="center">'.$prod->id.'</td><td background="#fff" align="center">'.$prod->titulo.'</td><td background="#fff" align="center">'.$prod->cantidad.'</td><td background="#fff" align="center">'.$prod->costo.'</td></tr>';
        }

        $productosRender .= '<tr><td></td><td></td><td background="#fff" align="center">Total</td><td background="#fff" align="center">'.$pedidos[0]->total_cost.'</td></tr></tbody></table>';
        $pdf = App::make('dompdf');
        $pdf->loadHTML('<h1 style="width:100%; text-align:center;">LOGO ANDALUCIA</h1><h2>Comprobante de canje</h2><ul><li><b>Cliente:</b> '.$pedidos[0]->user_id.'</li><li><b>ID del pedido:</b> '.$pedidos[0]->id.'</li><li><b>Costo:</b> '.$pedidos[0]->total_cost.'</li><li><b>Estado:</b> '.$pedidos[0]->estado.'</li><li><b>Productos:</b>'. $productosRender.'</li>Código de barras: <img src="'.$pedidos[0]->barcode.'">');
        return $pdf->stream();
    }

    //Productos más Canjeados
    public function mascanjeados(){

        $Pedidos = Pedidos::all();
        $productos2 = array();
        $products_id = $this->renderProductosPedidos($Pedidos, 'ids');

        $count=array_count_values($products_id);
        arsort($count);
        $mascanjeados=array_keys($count);

        foreach ($mascanjeados as $id) {
            $id = str_replace('"',"", $id);
            $producto = Productos::where('id', '=', $id)->get();
            if( $producto[0]->estado == true){
                $productos2[] = $producto[0];
            }
        }

        $socio = $this->getSocio();

        $mascanjeadostheme = View::make('ecommerce.modulos.mascanjeados', compact('productos2', 'socio'));

        return $mascanjeadostheme;
    }

    public function renderProductosPedidos($Pedidos, $tipo){
        $products_id = array();
        $products_id_p = array();
        $products_cant = array();
        foreach ($Pedidos as $pedido) {
            $pedidoLimpio = substr($pedido->products_id, 1, -1);
            $prod_id = explode(",", $pedidoLimpio);
            foreach ($prod_id as $id) {
                array_push($products_id, $id);
                array_push($products_id_p, array('id' => $id, 'pedido' => $pedido->id));
            }

            $cantidadLimpia = substr($pedido->products_quantity, 1, -1);
            $prod_cant = explode(",", $cantidadLimpia);
            foreach ($prod_cant as $cant) {
                array_push($products_cant, $cant);
            }
        } 
        
        if($tipo == 'ids'){
            return $products_id;
        }else if($tipo == 'idsP'){
            return $products_id_p;
        }
        else{
            return $products_cant;
        }
        
    }

    //socio
    public function getSocio(){
        $socio_id = Session::get('socio_id');
        $socio = Usuario::find($socio_id);

        return $socio;
    }

    //MODULOS

    //Category Filter
    public function categoryFilter(){

        $recomendados = Productos::take(4)->skip(4)->orderByRaw("RAND()")->get();
        $categorias = Categorias::all();

        $socio = $this->getSocio();

        $categoryfilter = View::make('ecommerce.modulos.categoryfilter', compact('categorias', 'recomendados', 'socio'));

        return $categoryfilter;
    }

}