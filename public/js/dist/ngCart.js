'use strict';


angular.module('ngCart', ['ngCart.directives'])

    .config([function () {

    }])

    .provider('$ngCart', function () {
        this.$get = function () {
        };
    })

    .run(['$rootScope', 'ngCart','ngCartItem', 'store', function ($rootScope, ngCart, ngCartItem, store) {
        $rootScope.$on('ngCart:change', function(){
            ngCart.$save();
        });

        if (angular.isObject(store.get('cart'))) {
            ngCart.$restore(store.get('cart'));

        } else {
            ngCart.init();
        }

    }])

    .service('ngCart', ['$rootScope', 'ngCartItem', 'store', function ($rootScope, ngCartItem, store) {

        this.init = function(){
            this.$cart = {
                shipping : null,
                taxRate : null,
                ruta : 'http://localhost/andalucia/public/',
                tax : null,
                items : [],
                wishItems : []
            };
        };

        this.addItem = function (id, name, price, quantity, data, userpoints, img, stock, userstate) {
            if(userstate == false){
                var totalPoints =  parseFloat(this.totalCost())+ (parseFloat(price) * parseFloat(quantity));
                //alert(stock);
                if(totalPoints <= userpoints && stock >= quantity){
                    var inCart = this.getItemById(id);

                    if (typeof inCart === 'object'){
                        //Update quantity of an item if it's already in the cart
                        inCart.setQuantity(quantity, false);
                    } else {
                        var newItem = new ngCartItem(id, name, price, quantity, data, userpoints, img, stock);
                        this.$cart.items.push(newItem);
                        $rootScope.$broadcast('ngCart:itemAdded', newItem);
                    }

                    $rootScope.$broadcast('ngCart:change', {});
                }else if(stock < quantity){
                    alert('Solo nos quedan ' + stock + ' ejemplares de este producto');
                }
                else{
                    alert('No te alcanza');
                }
            }else{
                alert('Tienes un pedido pendiente');
            }
        };

        this.addWishItem = function (id, name, price, quantity, data, userpoints, img, stock) {
            //userpoints = 300;
            if(parseFloat(price) > parseFloat(userpoints)){
                var tefalta = parseFloat(price) - parseFloat(userpoints);
                alert('Necesitas ' + price + ' puntos, tienes ' + userpoints + ' puntos. Te falta ' + tefalta);
            }

            var inCart = this.getWishItemsById(id);

            if (typeof inCart === 'object'){
                this.removeWishItemById(id);
            } else {
                var newItem = new ngCartItem(id, name, price, quantity, data, userpoints, img, stock);
                this.$cart.wishItems.push(newItem);
                $rootScope.$broadcast('ngCart:itemAdded', newItem);

                $rootScope.$broadcast('ngCart:change', {});
            }
        }

        this.getItemById = function (itemId) {
            var items = this.getCart().items;
            var build = false;

            angular.forEach(items, function (item) {
                if  (item.getId() === itemId) {
                    build = item;
                }
            });
            return build;
        };

        this.getWishHeardsById = function (itemId) {
            var wishItems = this.getCart().wishItems;
            var heardClass = 'apagado';

            angular.forEach(wishItems, function (item) {
                if  (item.getId() === itemId) {
                    heardClass = 'encendido';
                }else{
                    heardClass = 'apagado';
                }
            });
            return heardClass;
        };

        this.getWishItemsById = function (itemId) {
            var wishItems = this.getCart().wishItems;
            var build = false;

            angular.forEach(wishItems, function (item) {
                if  (item.getId() === itemId) {
                    build = item;
                }
            });
            return build;
        };
        

        this.setShipping = function(shipping){
            this.$cart.shipping = shipping;
            return this.getShipping();
        };

        this.getShipping = function(){
            if (this.getCart().items.length == 0) return 0;
            return  this.getCart().shipping;
        };

        this.setTaxRate = function(taxRate){
            this.$cart.taxRate = +parseFloat(taxRate).toFixed(2);
            return this.getTaxRate();
        };

        this.getTaxRate = function(){
            return this.$cart.taxRate
        };

        this.setRuta = function(ruta){
            //alert(ruta);
            this.$cart.ruta = ruta;
            return this.getRuta();
        };

        this.getRuta = function(){
            return this.$cart.ruta;
        };

        this.getTax = function(){
            return +parseFloat(((this.getSubTotal()/100) * this.getCart().taxRate )).toFixed(2);
        };

        this.setCart = function (cart) {
            this.$cart = cart;
            return this.getCart();
        };

        this.getCart = function(){
            return this.$cart;
        };

        this.getItems = function(){
            return this.getCart().items;
        };

        this.getWishItems = function(){
            return this.getCart().wishItems;
        };

        this.getTotalItems = function () {
            var count = 0;
            var items = this.getItems();
            angular.forEach(items, function (item) {
                count += item.getQuantity();
            });
            return count;
        };

        this.getTotalUniqueItems = function () {
            return this.getCart().items.length;
        };

        this.getSubTotal = function(){
            var total = 0;
            angular.forEach(this.getCart().items, function (item) {
                total += item.getTotal();
            });
            return +parseFloat(total).toFixed(2);
        };

        this.totalCost = function () {
            return +parseFloat(this.getSubTotal() + this.getShipping() + this.getTax()).toFixed(2);
        };

        this.removeItem = function (index) {
            this.$cart.items.splice(index, 1);
            $rootScope.$broadcast('ngCart:itemRemoved', {});
            $rootScope.$broadcast('ngCart:change', {});

        };

        this.removeItemById = function (id) {
            var cart = this.getCart();
            angular.forEach(cart.items, function (item, index) {
                if  (item.getId() === id) {
                    cart.items.splice(index, 1);
                }
            });
            this.setCart(cart);
            $rootScope.$broadcast('ngCart:itemRemoved', {});
            $rootScope.$broadcast('ngCart:change', {});
        };

        this.removeWishItemById = function (id) {
            //alert('ejecuto' + id);
            var cart = this.getCart();
            angular.forEach(cart.wishItems, function (item, index) {
                if  (item.getId() === id) {
                    cart.wishItems.splice(index, 1);
                }
            });
            this.setCart(cart);
            $rootScope.$broadcast('ngCart:itemRemoved', {});
            $rootScope.$broadcast('ngCart:change', {});
        };

        this.empty = function () {
            var wishItemsTemp = {};
            
            var cart = angular.fromJson(localStorage ['cart']);
            cart = JSON.parse(cart);

            angular.forEach(cart, function(key, value){
                if(value == 'wishItems'){
                   wishItemsTemp = key; 
                }
                
            });

            $rootScope.$broadcast('ngCart:change', {});
            this.$cart.items = [];

            localStorage.removeItem('cart');

            this.$cart.wishItems = wishItemsTemp;
            this.$save();
            //alert(this.$cart.wishItems);
        };

        this.toObject = function() {

            if (this.getItems().length === 0) return false;

            var items = [];
            angular.forEach(this.getItems(), function(item){
                items.push (item.toObject());
            });

            var wishItems = [];
            angular.forEach(this.getWishItems(), function(item){
                wishItems.push (item.toObject());
            });

            return {
                shipping: this.getShipping(),
                tax: this.getTax(),
                taxRate: this.getTaxRate(),
                ruta: this.getRuta(),
                subTotal: this.getSubTotal(),
                totalCost: this.totalCost(),
                items:items,
                wishItems:wishItems
            }
        };


        this.$restore = function(storedCart){
            var _self = this;
            _self.init();
            _self.$cart.shipping = storedCart.shipping;
            _self.$cart.tax = storedCart.tax;

            angular.forEach(storedCart.items, function (item) {
                _self.$cart.items.push(new ngCartItem(item._id,  item._name, item._price, item._quantity, item._data, item._userpoints, item._img, item._stock, item._userstate));
            });

            angular.forEach(storedCart.wishItems, function (item) {
                _self.$cart.wishItems.push(new ngCartItem(item._id,  item._name, item._price, item._data, item._userpoints, item._img));
            });

            this.$save();
        };

        this.$save = function () {
            return store.set('cart', JSON.stringify(this.getCart()));
        }

    }])

    .factory('ngCartItem', ['$rootScope', '$log', function ($rootScope, $log) {

        var item = function (id, name, price, quantity, data, userpoints,  img, stock, userstate) {
            this.setId(id);
            this.setName(name);
            this.setPrice(price);
            this.setQuantity(quantity, false, userpoints, price, data);
            this.setData(data);
            this.setUserpoints(userpoints);
            this.setImg(img);
            this.setStock(stock);
            this.setUserstate(userstate);
        };

        item.prototype.setUserstate = function(userstate){
            if (userstate)  this._userstate = userstate;
            else {
                //$log.error('Stock must be provided');
            }
        };

        item.prototype.getUserstate = function(){
            return this._userstate;
        };

        item.prototype.setStock = function(stock){
            if (stock)  this._stock = stock;
            else {
                //$log.error('Stock must be provided');
            }
        };

        item.prototype.getStock = function(){
            return this._stock;
        };

        item.prototype.setImg = function(img){
            if (img)  this._img = img;
            else {
                //$log.error('Image must be provided');
            }
        };

        item.prototype.getImg = function(){
            return this._img;
        };

        item.prototype.setUserpoints = function(userpoints){
            if (userpoints)  this._userpoints = userpoints;
            else {
                //$log.error('userpoints must be provided');
            }
        };

        item.prototype.getUserpoints = function(){
            return this._userpoints;
        };

        item.prototype.setId = function(id){
            if (id)  this._id = id;
            else {
                $log.error('An ID must be provided');
            }
        };

        item.prototype.getId = function(){
            return this._id;
        };


        item.prototype.setName = function(name){
            if (name)  this._name = name;
            else {
                $log.error('A name must be provided');
            }
        };
        item.prototype.getName = function(){
            return this._name;
        };

        item.prototype.setPrice = function(price){
            var priceFloat = parseFloat(price);
            if (priceFloat) {
                if (priceFloat <= 0) {
                    $log.error('A price must be over 0');
                } else {
                    this._price = (priceFloat);
                }
            } else {
                $log.error('A price must be provided');
            }
        };
        item.prototype.getPrice = function(){
            return this._price;
        };


        item.prototype.setQuantity = function(quantity, relative, userpoints, price, data){

            var quantityInt = parseInt(quantity);
            if (quantityInt % 1 === 0){
                if (relative === true){
                    this._quantity  += quantityInt;
                } else {
                    this._quantity = quantityInt;
                }
                if (this._quantity < 1) this._quantity = 1;

            } else {
                this._quantity = 1;
                $log.info('Quantity must be an integer and was defaulted to 1');
            }
            $rootScope.$broadcast('ngCart:change', {});

        };

        item.prototype.setQuantityButton = function(quantity, relative, userpoints, price, data, stock){

            if (userpoints == undefined ){
                userpoints = this._userpoints;
            }
            var cantidadtotal = parseFloat(this._quantity) + parseFloat(quantity);
            var totalPoints =  parseFloat(this.getFullTotal()) + parseFloat(this._price);
            
            if(totalPoints <= userpoints && cantidadtotal <= this._stock || quantity < 0 ){

                var quantityInt = parseInt(quantity);
                if (quantityInt % 1 === 0){
                    if (relative === true){
                        this._quantity  += quantityInt;
                    } else {
                        this._quantity = quantityInt;
                    }
                    if (this._quantity < 1) this._quantity = 1;

                } else {
                    this._quantity = 1;
                    $log.info('Quantity must be an integer and was defaulted to 1');
                }
                $rootScope.$broadcast('ngCart:change', {});
            }else if(cantidadtotal > this._stock){
                alert('Solo nos quedan ' + this._stock + ' ejemplares de este producto');
            }else{
                alert('No te alcanza');
            }

        };

        item.prototype.setTotal= function(total){
            this._total = total;
        }

        item.prototype.getFullTotal= function(total){
            return this._total;
        }

        item.prototype.getQuantity = function(){
            return this._quantity;
        };

        item.prototype.setData = function(data){
            if (data) this._data = data;
        };

        item.prototype.getData = function(){
            if (this._data) return this._data;
            else $log.info('This item has no data');
        };


        item.prototype.getTotal = function(){
            return +parseFloat(this.getQuantity() * this.getPrice()).toFixed(2);
        };

        item.prototype.toObject = function() {
            return {
                id: this.getId(),
                name: this.getName(),
                price: this.getPrice(),
                quantity: this.getQuantity(),
                data: this.getData(),
                total: this.getTotal(),
                userpoints: this.getUserpoints(),
                img: this.getImg(),
                stock: this.getStock(),
                userstate: this.getUserstate()

            }
        };

        return item;

    }])

    .service('store', ['$window', function ($window) {

        return {

            get: function (key) {
                if ($window.localStorage [key]) {
                    var cart = angular.fromJson($window.localStorage [key]);
                    return JSON.parse(cart);
                }
                return false;

            },


            set: function (key, val) {

                if (val === undefined) {
                    $window.localStorage .removeItem(key);
                } else {
                    $window.localStorage [key] = angular.toJson(val);
                }
                return $window.localStorage [key];
            }
        }
    }])

    .controller('CartController',['$scope', 'ngCart', function($scope, ngCart) {
        $scope.ngCart = ngCart;

    }])

    .value('version', '0.0.3-rc.1');
;'use strict';


angular.module('ngCart.directives', ['ngCart.fulfilment', 'ngCart.rate'])

    .controller('CartController',['$scope', 'ngCart', function($scope, ngCart) {
        $scope.ngCart = ngCart;
    }])

    .directive('ngcartAddtocart', ['ngCart', function(ngCart){
       
        return {
            restrict : 'E',
            controller : 'CartController',
            scope: {
                id:'@',
                name:'@',
                quantity:'@',
                quantityMax:'@',
                price:'@',
                data:'=',
                userpoints:'@',
                img:'@',
                stock:'@',
                userstate:'@'
            },
            transclude: true,
            templateUrl: ngCart.getRuta() + 'template/ngCart/addtocart.html',
            link:function(scope, element, attrs){                
                scope.attrs = attrs;
                scope.inCart = function(){
                    return  ngCart.getItemById(attrs.id);
                };

                scope.valor = false;

                scope.getWishHeardsById = function (itemId) {
                    var result = true;

                    var wishItems = ngCart.getCart().wishItems;

                    angular.forEach(wishItems, function (item) {
                        if  (item.getId() === itemId) {
                            result = false;
                            //alert('esta');
                        }
                    });

                    return scope.valor = result;
                };


                if (scope.inCart()){
                    scope.q = ngCart.getItemById(attrs.id).getQuantity();
                } else {
                    scope.q = parseInt(scope.quantity);
                }

                scope.qtyOpt =  [];
                for (var i = 1; i <= scope.quantityMax; i++) {
                    scope.qtyOpt.push(i);
                }

            }

        };
    }])

    .directive('ngcartCart', ['ngCart', function(ngCart){
        return {
            restrict : 'E',
            controller : 'CartController',
            scope: {},
            templateUrl: ngCart.getRuta() + 'template/ngCart/cart.html',
            link:function(scope, element, attrs){

            }
        };
    }])

    .directive('ngcartSummary', ['ngCart', function(ngCart){
        return {
            restrict : 'E',
            controller : 'CartController',
            scope: {},
            transclude: true,
            templateUrl: ngCart.getRuta() + 'template/ngCart/summary.html'
        };
    }])

    .directive('ngcartWishlist', ['ngCart', function(ngCart){
        return {
            restrict : 'E',
            controller : 'CartController',
            scope: {},
            transclude: true,
            templateUrl: ngCart.getRuta() + 'template/ngCart/wishlist.html'
        };
    }])

    .directive('ngcartCheckout', ['ngCart', function(ngCart){
        return {
            restrict : 'E',
            controller : ('CartController', ['$scope', 'ngCart', 'fulfilmentProvider', function($scope, ngCart, fulfilmentProvider) {
                $scope.ngCart = ngCart;

                $scope.checkout = function () {
                    fulfilmentProvider.setService($scope.service);
                    fulfilmentProvider.setSettings($scope.settings);
                    var promise = fulfilmentProvider.checkout();
                    console.log(promise);
                }
            }]),
            scope: {
                service:'@',
                settings:'='
            },
            transclude: true,
            templateUrl: ngCart.getRuta() + 'template/ngCart/checkout.html'
        };
    }])

    .directive('ngcartRate', ['ngCart', function(ngCart){
        return {
            restrict : 'E',
            controller : ('CartController', ['$scope', 'ngCart' , 'rateProvider', function($scope, ngCart, rateProvider) {
                $scope.max = 5;

                $scope.$watch('valor', function(newValue, oldValue) {
                    if (newValue !== null && newValue !== undefined) {
                        $scope.updateStars();
                    }
                });

                $scope.updateStars = function(){
                    var idx = 0;
                    $scope.stars = [ ];
                    for (idx = 0; idx < $scope.max; idx += 1) {
                        $scope.stars.push({
                            full: $scope.valor > idx
                        });
                    }

                    return $scope.stars;
                }

                $scope.setRating = function(idx) {
                   $scope.valor = idx + 1;

                   $scope.rate($scope.valor);
                };

                $scope.hover = function(idx) {
                    $scope.hoverIdx = idx;
                };

                $scope.stopHover = function() {
                    $scope.hoverIdx = -1;
                };

                $scope.starColor = function(idx) {
                    var starClass = 'rating-normal';
                    if (idx <= $scope.hoverIdx) {
                        starClass = 'rating-highlight';
                    }
                    return starClass;
                };

                $scope.rate = function (idx) {
                    rateProvider.setService($scope.service);
                    rateProvider.setSettings($scope.settings);
                    rateProvider.setValor(idx);
                    rateProvider.setId($scope.id);
                    rateProvider.setUser($scope.user);
                    var promise = rateProvider.checkout();
                    console.log(promise);
                }
            }]),
            scope: {
                service:'@',
                settings:'=',
                valor: '@',
                id: '@',
                user: '@'
        },
            transclude: false,
            templateUrl: ngCart.getRuta() + 'template/ngCart/rate.html'
        };
    }]);


angular.module('ngCart.rate', [])
    .service('rateProvider', ['$injector', function($injector){
        this._obj = {
            service : undefined,
            settings : undefined,
            valor : undefined,
            id : undefined,
            user : undefined
        };

        this.setService = function(service){
            this._obj.service = service;
        };

        this.setSettings = function(settings){
            this._obj.settings = settings;
        };

        this.setValor = function(valor){
            this._obj.valor = valor;
        };

        this.setId = function(id){
            this._obj.id = id;
        };

        this.setUser = function(user){
            this._obj.user = user;
        };

        this.checkout = function(){
            var provider = $injector.get('ngCart.rate.' + this._obj.service);
            return provider.rate(this._obj.settings, this._obj.valor, this._obj.id, this._obj.user);

        }

    }])
    .service('ngCart.rate.http', ['$http', 'ngCart', function($http, ngCart){

        this.rate = function(settings, idx, prod_id, user){

            var data = [{'rate':idx, 'prod_id':prod_id, 'user':user }];

            //alert(JSON.stringify(data));

            return $http.post(settings.url,
                data)
                .success(function (data, status, headers, config) {
                    //alert('hola');
                }).error(function(data, status, headers, config) {
                    //alert('hola2');
                });;
        }
    }]);

angular.module('ngCart.fulfilment', [])
    .service('fulfilmentProvider', ['$injector', function($injector){

        this._obj = {
            service : undefined,
            settings : undefined
        };

        this.setService = function(service){
            this._obj.service = service;
        };

        this.setSettings = function(settings){
            this._obj.settings = settings;
        };

        this.checkout = function(){
            var provider = $injector.get('ngCart.fulfilment.' + this._obj.service);
              return provider.checkout(this._obj.settings);

        }

    }])


.service('ngCart.fulfilment.log', ['$q', '$log', 'ngCart', function($q, $log, ngCart){

        this.checkout = function(){

            var deferred = $q.defer();

            $log.info(ngCart.toObject());
            deferred.resolve({
                cart:ngCart.toObject()
            });

            return deferred.promise;

        }

 }])

.service('ngCart.fulfilment.http', ['$http', 'ngCart', function($http, ngCart){

        this.checkout = function(settings){

            return $http.post(settings.url,
                {data:ngCart.toObject()})
                .success(function (data, status, headers, config) {
                    
                    //var datos = JSON.stringify(config);
                    //var total = config.data.data.totalCost;
                    //var items = config.data.data.items;

                    //alert(items[0].name);

                    ngCart.empty();
                    document.getElementById("message").innerHTML = data;
                });
        }
 }])


.service('ngCart.fulfilment.paypal', ['$http', 'ngCart', function($http, ngCart){


}]);