/**
 * Created by Luis Macias on 26/08/2015.
 */
var app = angular.module('ang-app', [], function ($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('productos', function ($scope, $http) {
	$scope.showProductos = function (idCliente) {

		var dataURL   = $('select[name="cliente_id"]').attr('data-url');
		$scope.select = idCliente;
		$http.get(dataURL + "/" + idCliente)
			.success(function (data) {
				$scope.listado = data;
			})
			.error(function (err) {
				console.log(err);
			});
	}
});