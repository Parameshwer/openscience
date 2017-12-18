app.controller('loginController', function($scope,$rootScope,$http){
    $scope.checkLogin = function(user) {       
        $http({
            url: base_url+'admin/validate_credentials',
            method: "POST",
            data: user
        })
        .then(function(response) {            
            //window.location = base_url+'admin#/Dashboard'
        });
    }
});
app.controller('dashboardController', function($scope,$rootScope,$http){        
    $http({
        url: base_url+'dashboard',
        method: "POST"        
    })
    .then(function(response) {
        $scope.count = response.data[0];
        return $scope;
    });    
});
app.controller('wysiwygeditor', ['$scope', 'textAngularManager', function wysiwygeditor($scope, textAngularManager) {
    $scope.version = textAngularManager.getVersion();
    $scope.versionNumber = $scope.version.substring(1);
    $scope.orightml = '';
    $scope.htmlcontent = $scope.orightml;
    $scope.disabled = false;
}]);

/*
app.controller('mainCategoryController', ['$scope','$rootScope','$uibModal', '$log', '$document','$http','$timeout', function($scope,$rootScope,$uibModal, $log, $document,$http,$timeout) {
    var self = this;
    self.spinner = true;        
    self.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 100,
        virtualizationThreshold: 75,
        rowHeight:40,
        columnDefs: [          
          { name: 'category_name' },
          { name: 'created_date' },          
          { name: 'updated_date'},
          { displayName: 'Edit',
            name: 'category_id',
            cellTemplate: '<a class="modify-icon" href="http://localhost/openscience/admin#!/admin/EditMainCategory/10" >Edit</a>'
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };

    self.getTableHeight = function() {       
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    self.searchGrid = function(search_value) {
        self.spinner = true; 
        $timeout(function() {
            getCategories(search_value);            
        },1000);
    }
    $scope.test = function() {
        
        var modalInstance = $uibModal.open({          
          ariaLabelledBy: 'modal-title',
          ariaDescribedBy: 'modal-body',
          templateUrl: base_url+'public/angular-templates/edit-maincategory.html',          
          appendTo: angular.element('body'),
          controller:ModalInstanceCtrl,          
          size: 'sm'

        });
    }
    getCategories("");

    function getCategories(search_value) {
        $http({
            url: base_url+'admin/get_categories',
            method: "POST",
            data : JSON.stringify({"search_value":search_value})        
        })
        .then(function(response) {        
            self.gridOptions1.data = response.data;
             $timeout(function() {
                self.spinner= false;
             }, 500);
        });              
    }
}]);
app.controller('ModalInstanceCtrl', function ($uibModalInstance, items) {
  var $ctrl = this;
  $ctrl.items = items;
  $ctrl.selected = {
    item: $ctrl.items[0]
  };

  $ctrl.ok = function () {
    $uibModalInstance.close($ctrl.selected.item);
  };

  $ctrl.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});


app.controller('editMaincategoryController', function($scope,$rootScope,$routeParams,$location,factory,main_category) {        
    alert('aaa');
    console.log(main_category);
    var main_cat_id = ($routeParams.MaincatID) ? parseInt($routeParams.MaincatID) : 0;
    $rootScope.title = (main_cat_id > 0) ? 'Edit Category' : 'Add Category';
    $scope.buttonText = (main_cat_id > 0) ? 'Update Category' : 'Add New Category';    
    var original = main_category.data[0];    
    $scope.main_category = original;
    $scope.isClean = function() {
       return angular.equals(original, $scope.main_category);
    }
    $scope.saveCategory = function(main_category) {
        $scope.server_msg = 'Details are saving....';
        if (main_cat_id <= 0) {
            factory.updateCategory("0",main_category,$scope);            
        }
        else {
            factory.updateCategory(main_cat_id, main_category,$scope);
        }
    }
});


*/