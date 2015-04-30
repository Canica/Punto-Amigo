@extends('ecommerce.layout')

@section('cart')
    <div class="categoria row">
    
        <h4>{{$resultado}}</h4>
        <div ng-init='products = <?=$products?>' >

            <div class="button-bar">
                <ul class="stack-for-small secondary button-group show-for-medium-up">
                    <li><a href="#" class="button tiny secondary disabled ">Ordenar por:</a></li>
                </ul>
               <ul class="button-group round sortUl">
                    <li><a href="" ng-click="predicate = 'titulo'; reverse=false" class="button tiny"><span class="show-for-medium-up">Nombre ASE</span>
                        <span class="show-for-small-only">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                            <path fill="#fff" d="M5 12v-12h-2v12h-2.5l3.5 3.5 3.5-3.5h-2.5z"></path>
                            <path fill="#fff" d="M14.5 16h-4c-0.184 0-0.354-0.101-0.441-0.264s-0.077-0.36 0.025-0.513l3.482-5.223h-3.066c-0.276 0-0.5-0.224-0.5-0.5s0.224-0.5 0.5-0.5h4c0.184 0 0.354 0.101 0.441 0.264s0.077 0.36-0.025 0.513l-3.482 5.223h3.066c0.276 0 0.5 0.224 0.5 0.5s-0.224 0.5-0.5 0.5z"></path>
                            <path fill="#fff" d="M15.947 6.276l-3-6c-0.085-0.169-0.258-0.276-0.447-0.276s-0.363 0.107-0.447 0.276l-3 6c-0.123 0.247-0.023 0.547 0.224 0.671 0.072 0.036 0.148 0.053 0.223 0.053 0.183 0 0.36-0.101 0.448-0.277l0.862-1.724h3.382l0.862 1.724c0.123 0.247 0.424 0.347 0.671 0.224s0.347-0.424 0.224-0.671zM11.309 4l1.191-2.382 1.191 2.382h-2.382z"></path>
                            </svg>
                        </span></a>
                    </li>
                    <li><a href="" ng-click="predicate = '-titulo'; reverse=false" class="button tiny"><span class="show-for-medium-up">Nombre DES</span>
                        <span class="show-for-small-only">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                            <path fill="#fff" d="M5 12v-12h-2v12h-2.5l3.5 3.5 3.5-3.5h-2.5z"></path>
                            <path fill="#fff" d="M14.5 7h-4c-0.184 0-0.354-0.101-0.441-0.264s-0.077-0.36 0.025-0.513l3.482-5.223h-3.066c-0.276 0-0.5-0.224-0.5-0.5s0.224-0.5 0.5-0.5h4c0.184 0 0.354 0.102 0.441 0.264s0.077 0.36-0.025 0.513l-3.482 5.223h3.066c0.276 0 0.5 0.224 0.5 0.5s-0.224 0.5-0.5 0.5z"></path>
                            <path fill="#fff" d="M15.947 15.276l-3-6c-0.085-0.169-0.258-0.276-0.447-0.276s-0.363 0.107-0.447 0.276l-3 6c-0.123 0.247-0.023 0.547 0.224 0.671 0.072 0.036 0.148 0.053 0.223 0.053 0.183 0 0.36-0.101 0.448-0.277l0.862-1.724h3.382l0.862 1.724c0.123 0.247 0.424 0.347 0.671 0.224s0.347-0.424 0.224-0.671zM11.309 13l1.191-2.382 1.191 2.382h-2.382z"></path>
                            </svg>
                        </span></a>
                    </li>
                    <li><a href="" ng-click="predicate = 'costo'; reverse=reverse" class="button tiny"><span class="show-for-medium-up">Puntos ASE</span>
                        <span class="show-for-small-only">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                            <path fill="#fff" d="M5 12v-12h-2v12h-2.5l3.5 3.5 3.5-3.5h-2.5z"></path>
                            <path fill="#fff" d="M13.5 16c-0.276 0-0.5-0.224-0.5-0.5v-5.5h-0.5c-0.276 0-0.5-0.224-0.5-0.5s0.224-0.5 0.5-0.5h1c0.276 0 0.5 0.224 0.5 0.5v6c0 0.276-0.224 0.5-0.5 0.5z"></path>
                            <path fill="#fff" d="M14.5 0h-3c-0.276 0-0.5 0.224-0.5 0.5v3c0 0.276 0.224 0.5 0.5 0.5h2.5v2h-2.5c-0.276 0-0.5 0.224-0.5 0.5s0.224 0.5 0.5 0.5h3c0.276 0 0.5-0.224 0.5-0.5v-6c0-0.276-0.224-0.5-0.5-0.5zM12 1h2v2h-2v-2z"></path>
                            </svg>
                        </span></a>
                    </li>
                    <li><a href="" ng-click="predicate = '-costo'; reverse=false" class="button tiny"><span class="show-for-medium-up">Puntos DES</span>
                        <span class="show-for-small-only">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                            <path fill="#fff" d="M5 12v-12h-2v12h-2.5l3.5 3.5 3.5-3.5h-2.5z"></path>
                            <path fill="#fff" d="M13.5 7c-0.276 0-0.5-0.224-0.5-0.5v-5.5h-0.5c-0.276 0-0.5-0.224-0.5-0.5s0.224-0.5 0.5-0.5h1c0.276 0 0.5 0.224 0.5 0.5v6c0 0.276-0.224 0.5-0.5 0.5z"></path>
                            <path fill="#fff" d="M14.5 9h-3c-0.276 0-0.5 0.224-0.5 0.5v3c0 0.276 0.224 0.5 0.5 0.5h2.5v2h-2.5c-0.276 0-0.5 0.224-0.5 0.5s0.224 0.5 0.5 0.5h3c0.276 0 0.5-0.224 0.5-0.5v-6c0-0.276-0.224-0.5-0.5-0.5zM12 10h2v2h-2v-2z"></path>
                            </svg>
                        </span></a>
                    </li>
                </ul>
            </div>

            <div ng-repeat="product in products.data | orderBy:predicate:reverse" class="producto small-12 medium-4 large-3 columns">
                <div class="img_product">
                    <img src="{{url('/')}}/img/productos/@{{product.imagen}}" alt="@{{product.titulo}}" />
                </div>
                <div class="panel">
                    <h3>@{{product.titulo}}</h3>
                    <div class="costo">
                        @{{product.costo}} <i>puntos</i>
                    </div>
                </div>
                <div class="tools">
                    <ngcart-addtocart id="@{{product.id}}" name="@{{product.titulo}}" price="@{{product.costo}}" quantity="1" quantity-max="5" data="item" userpoints="2000"  img="{{url('/')}}/img/productos/@{{product.imagen}}" stock="@{{product.stock}}" >
                        <div class="show-for-small-only">Añadir al carrito</div>
                        <div class="show-for-medium-up"><img src="{{url('/')}}/img/anadir.png"></div>
                    </ngcart-addtocart>
                </div>
                <div class="description">
                    <div class="texto">
                        @{{product.description}}
                    </div>
                </div>
            </div>
        </div>
        <div id="loading">Cargando Productos</div>

    </div>
    <!--$productos->links()-->
@stop