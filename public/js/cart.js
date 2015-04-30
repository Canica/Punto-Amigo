var myApp = angular.module('CarritoApp', ['infinite-scroll', 'ngCart']);

myApp.controller ('cart', ['$scope', '$http', 'ngCart', function($scope, $http, ngCart, Reddit) {

    ngCart.setTaxRate(0);
    ngCart.setShipping(0);

    ruta = 'http://localhost/andalucia/public/';

    var page = 2;
    $('#loading').css('display', 'none');

    $scope.loadMore = function(catid, lastpage) {
    	$('#loading').css('display', 'block');
    	if(page < lastpage + 1){

	    	var MainData = $scope.products.data;

			$http.get(ruta + 'json/'+ catid +'/' + page).
			  success(function(data, status, headers, config) {		  	
			  	
			  	var items = data.data;
			    for (var i = 0; i < items.length; i++) {
			    	MainData.push(items[i]);
			    }

			  	page ++;
			    console.log(data.data);
			    $('#loading').css('display', 'none');

			  }).
			  error(function(data, status, headers, config) {
			    console.log('error');
			  });

			 $scope.bussy = false;

		}
	};


	$('.checkoutButton').click(function (){
	    var checked = this.checked;
	    alert('sss');
	});

}]);





