app.controller('journalController', journalController);
app.controller('journalEditController', journalEditController);
app.service('journalService', journalService);

journalController.$inject = ['$scope', '$http', '$uibModal', 'journalService', 'uiGridConstants'];

function journalController($scope, $http, $uibModal, journalService, uiGridConstants) {
    var journalCtrl = this;
        journalCtrl.spinner = true;
    journalCtrl.editRow = journalService.editRow;

    journalCtrl.serviceGrid = {
        enableRowSelection: true,
        enableRowHeaderSelection: false,
        multiSelect: false,
        enableSorting: true,
        enableColumnMenus: false,
        virtualizationThreshold: 75
    };

    journalCtrl.serviceGrid.columnDefs = [
        {
            field: 'journal_name',
            enableSorting: true,
            enableCellEdit: false,  
            width: 350
        },
        {
            field: 'issn_number',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'journal_url_slug',
            enableSorting: true,
            enableCellEdit: false
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,                               
            width: 150,            
            cellTemplate: '<a ng-click=\"grid.appScope.journalCtrl.editRow(grid, row)\" class="modify-icon">Edit</a>'
        }
    ];

    /*$http.get('data.json').success(function(response) {
      journalCtrl.serviceGrid.data = response;
    });*/
    getJournals("");

    function getJournals(search_value) {
        $http({
            url: base_url + 'admin/get_journals',
            method: "POST",
            data : JSON.stringify({"search_value":search_value}) 
        })
        .then(function(response) {
            console.log(response);
            if(response) {
                journalCtrl.spinner = false;                
                journalCtrl.serviceGrid.data = response.data;
            }
        });
        
    }

    
    journalCtrl.getTableHeight = function() {           
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    journalCtrl.searchGrid = function(search_value) {
        journalCtrl.spinner = true; 
        setTimeout(function() {
            getJournals(search_value);            
        },1000);
    }

    journalCtrl.addCategory = function() {
        var date = new Date();
        var newService = {
            "id": "0"            
        };
        var rowTmp = {};
        rowTmp.entity = newService;
        journalCtrl.editRow($scope.journalCtrl.serviceGrid, rowTmp);
    };

}

journalService.$inject = ['$http', '$rootScope', '$uibModal'];

function journalService($http, $rootScope, $uibModal) {
    var service = {};
    service.editRow = editRow;

    function editRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/edit-journals.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', journalEditController],
            controllerAs: 'journalCtrl',
            size: 'lg',
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

function journalEditController($http, $uibModalInstance, grid, row) {
    var journalCtrl = this;    
    journalCtrl.entity = angular.copy(row.entity);
    journalCtrl.save = save;
    function save() {            
        $http({
            url: base_url+"admin/insert_journal",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            //data : JSON.stringify({"category_id":journalCtrl.entity.category_id,"category_name":journalCtrl.entity.category_name})          
            data: JSON.stringify(journalCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                journalCtrl.server_msg = response.data.message;
                if (response.data.row_id == '0') {
                    row.entity = angular.extend(row.entity, journalCtrl.entity);
                    row.entity.id = 10;
                    grid.data.push(row.entity);

                } else {
                    row.entity = angular.extend(row.entity, journalCtrl.entity);
                }                            
                setTimeout(function() {
                    journalCtrl.server_msg = '';
                    $uibModalInstance.close(row.entity);
                },1500);       
            }
        }); 
    }

    journalCtrl.remove = remove;

    function remove() {
        console.dir(row)
        if (row.entity.id != '0') {
            row.entity = angular.extend(row.entity, journalCtrl.entity);
            var index = grid.appScope.journalCtrl.serviceGrid.data.indexOf(row.entity);
            grid.appScope.journalCtrl.serviceGrid.data.splice(index, 1);
        }
        $uibModalInstance.close(row.entity);
    }

}