app.controller('mainCategoryController', mainCategoryController);
app.controller('editMainCategoryController', editMainCategoryController);
app.service('mainCategoryService', mainCategoryService);

mainCategoryController.$inject = ['$scope', '$http', '$uibModal', 'mainCategoryService', 'uiGridConstants'];

function mainCategoryController($scope, $http, $uibModal, mainCategoryService, uiGridConstants) {
    var vm = this;
        vm.spinner = true;
    vm.editRow = mainCategoryService.editRow;

    vm.serviceGrid = {
        enableRowSelection: true,
        enableRowHeaderSelection: false,
        multiSelect: false,
        enableSorting: true,
        enableColumnMenus: false
    };

    vm.serviceGrid.columnDefs = [
        {
            field: 'category_name',
            enableSorting: true,
            enableCellEdit: false,
            width: 250
        },
        {
            field: 'created_date',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'updated_date',
            enableSorting: true,
            enableCellEdit: false
        },
        {            
            field: 'category_id',
            displayName: '', 
            enableSorting: false,                               
            width: 150,            
            cellTemplate: '<a ng-click=\"grid.appScope.vm.editRow(grid, row)\" class="modify-icon">Edit</a>'
        }
    ];

    /*$http.get('data.json').success(function(response) {
      vm.serviceGrid.data = response;
    });*/
    getCategories("");

    function getCategories(search_value) {
        $http({
            url: base_url + 'get_categories',
            method: "POST",
            data : JSON.stringify({"search_value":search_value}) 
        })
        .then(function(response) {            
            vm.spinner = false;
            if(response.data.length > 0) {
                vm.serviceGrid.data = response.data;
            }                            
        });
        
    }

    
    vm.getTableHeight = function() {           
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    vm.searchGrid = function(search_value) {
        vm.spinner = true; 
        setTimeout(function() {
            getCategories(search_value);            
        },1000);
    }

    vm.addCategory = function() {
        var date = new Date();
        var newService = {
            "category_id": "0",
            "category_name": "",
            "created_date": date,
            "updated_date": date
        };
        var rowTmp = {};
        rowTmp.entity = newService;
        vm.editRow($scope.vm.serviceGrid, rowTmp);
    };

}

mainCategoryService.$inject = ['$http', '$rootScope', '$uibModal'];

function mainCategoryService($http, $rootScope, $uibModal) {
    var service = {};
    service.editRow = editRow;

    function editRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/edit-maincategory.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', editMainCategoryController],
            controllerAs: 'vm',
            resolve: {
                grid: function() {
                    return grid;
                },
                row: function() {
                    return row;
                }
            }
        });
    }

    return service;
}

function editMainCategoryController($http, $uibModalInstance, grid, row) {
    var vm = this;    
    vm.entity = angular.copy(row.entity);
    vm.save = save;
    function save() {            
        $http({
            url: base_url+"admin/insert_main_category",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify({"category_id":vm.entity.category_id,"category_name":vm.entity.category_name})          
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                vm.server_msg = response.data.message;
                if (response.data.row_id == '0') {
                    row.entity = angular.extend(row.entity, vm.entity);                    
                    row.entity.category_id = response.data.row_id;
                    grid.data.push(row.entity);

                } else {
                    row.entity = angular.extend(row.entity, vm.entity);
                }
                                
            }
        }); 
        setTimeout(function() {
            vm.server_msg = '';
            $uibModalInstance.close(row.entity);
        },1500);       
    }

    vm.remove = remove;

    function remove() {
        console.dir(row)
        if (row.entity.id != '0') {
            row.entity = angular.extend(row.entity, vm.entity);
            var index = grid.appScope.vm.serviceGrid.data.indexOf(row.entity);
            grid.appScope.vm.serviceGrid.data.splice(index, 1);
        }
        $uibModalInstance.close(row.entity);
    }

}