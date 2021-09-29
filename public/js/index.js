

var app=angular.module('appIndex', ['ngMaterial','ngMessages','ngAria','stripe.checkout']);
app.factory('Principal', function($http) {
    return {
      get : function() {
        return $http.get('getindex');
      },
      update : function(pdata) {
        return $http({
          method: 'POST',
          url: 'transaccion',
          headers: { 'Content-Type' : 'application/json' },
           data: pdata
        });
      }
      
    }
  })
app.controller('indexCtrl', function($scope,Principal,$location, $timeout,$http,$filter,$mdDialog) {
    $scope.txt="hola";
    $scope.currecies=[];
    $scope.crytos=[];
    $scope.panel=[];
    $scope.selectedId = 0;
    //* test */
   // $scope.currecies=[];
    Principal.get()
    .success(function(data) {
        $scope.currencies=data.currencies;
        $scope.currency=data.defaultCurrency;
        $scope.crypto=data.defaultCrypto;
        $scope.cryptos=data.cryptos;
        $scope.panelx=data.panel;
        $scope.selectedId = 1;
        $scope.key = data.key;
        console.log($scope.panel);
    });
    $scope.showAlert = function(ev) {
      $mdDialog.show(
        $mdDialog.alert()
          .parent(angular.element(document.querySelector('#popupContainer')))
          .clickOutsideToClose(true)
          .title('Datos incompletos')
          .textContent('Por favor ingrese correctamente sus datos')
          .ariaLabel('Alert Dialog Demo')
          .ok('Aceptar')
          .targetEvent(ev)
      );
    };

    $scope.selectedUser = function() {
     if($scope.selectedId==0){
      return;
     }
      return $filter('filter')($scope.panelx, { id:$scope.selectedId })[0];
    };

     $scope.pay = function() {

      if(this.projectForm.$valid){
      var token = function(res){
       var user={
        'name':$scope.projectForm.name.$modelValue,
        'lastname':$scope.projectForm.lastname.$modelValue,
        'email':$scope.projectForm.email.$modelValue,
      }
      var info={
        'key':$scope.key,
        'token':res.id,
        'compra':$scope.selectedUser(),
        'currency':$scope.currency,
        'cripto':$scope.key,
        'user':user,
      };
      Principal.update({"info":info,"key":$scope.key})
        .success(function(response) {
          console.log(response)

          /*
          if (data.response=="false"){
             alert("Plan Actualizado con exito");
             location.href="https://megacursos.com/admin/plans";

          }
          if (data.response=="error"){
             alert("ha ocurrido un error al guardar el plan");

          }
          */
        }) 
      };
      multi=100;
      if(($scope.currency=='CLP')||($scope.currency=='PYG'))
          {
            multi=1;
        }
      var amount = ($scope.selectedUser().pagar)*multi;
      var currency = $scope.currency;
      var coint = 'Compra '+$scope.crypto;
      StripeCheckout.open({
        key:         'pk_test_EkxcZ26WgVj5NQ3HT4gPS6KI',
        amount:      amount,
        locale:      'es',
        name:        'DameCoins® ',
        image:       '',
        description: 'Compra criptomonedas con tarjeta',
        panelLabel:  coint,
        currency:     currency,
        token:       token
      });
      return false;  
  }else{
    $scope.projectForm.$submitted = true;
    $scope.showAlert();

  }
}



});