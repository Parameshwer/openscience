app.controller('ebController', ebController);
app.controller('ebMemberEditController', ebMemberEditController);
app.controller('ebMemberDeleteController', ebMemberDeleteController);
app.service('ebMemberEditService', ebMemberEditService);
app.service('ebMemberDeleteService', ebMemberDeleteService);

ebController.$inject = ['$scope', '$http', '$uibModal', 'ebMemberEditService','ebMemberDeleteService', 'uiGridConstants'];

function ebController($scope, $http, $uibModal, ebMemberEditService,ebMemberDeleteService, uiGridConstants,$rootScope) {
    var ebCtrl = this;
        ebCtrl.spinner = true;
    ebCtrl.editRow = ebMemberEditService.editRow;
    ebCtrl.deleteRow = ebMemberDeleteService.deleteRow;

    ebCtrl.serviceGrid = {
        enableRowSelection: true,
        enableRowHeaderSelection: false,
        multiSelect: false,
        enableSorting: true,
        enableColumnMenus: false,
        virtualizationThreshold: 250
    };

    ebCtrl.serviceGrid.columnDefs = [
        {
            field: 'journal_name',
            enableSorting: true,
            enableCellEdit: false,
            width: 300
        },
        {
            field: 'eb_member_name',
            enableSorting: true,
            enableCellEdit: false,
            width: 150
        },
        {
            field: 'eb_member_photo',
            enableSorting: true,
            enableCellEdit: false,
            width: 200
        },
        {
            field: 'eb_member_country',
            enableSorting: true,
            enableCellEdit: false,
            width: 150
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,   
            cellTemplate: '<a ng-click=\"grid.appScope.ebCtrl.editRow(grid, row)\" class="modify-icon">Edit</a>'
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,   
            cellTemplate: '<a ng-click=\"grid.appScope.ebCtrl.deleteRow(grid, row)\" class="modify-icon">Delete</a>'
        }
    ];

    /*$http.get('data.json').success(function(response) {
      ebCtrl.serviceGrid.data = response;
    });*/
    
    getJournalPosts("");

    function getJournalPosts(search_value) {
        $http({
            url: base_url + 'get_new_eb_members',
            method: "POST",
            data : JSON.stringify({"search_value":search_value}) 
        })
        .then(function(response) {
            console.log(response);
            if(response) {
                ebCtrl.spinner = false;                
                ebCtrl.serviceGrid.data = response.data;
            }
        });
        //$rootScope.journals = {};
       
        
    }

    
    ebCtrl.getTableHeight = function() {           
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    ebCtrl.searchGrid = function(search_value) {
        ebCtrl.spinner = true; 
        setTimeout(function() {
            getJournalPosts(search_value);            
        },1000);
    }

    ebCtrl.addMember = function() {
        var date = new Date();
        var newService = {
            "id": "0"            
        };
        var rowTmp = {};
        rowTmp.entity = newService;
        ebCtrl.editRow($scope.ebCtrl.serviceGrid, rowTmp);
    };

}

ebMemberEditService.$inject = ['$http', '$rootScope', '$uibModal'];
ebMemberDeleteService.$inject = ['$http', '$rootScope', '$uibModal'];


function ebMemberEditService($http, $rootScope, $uibModal) {
   
    var service = {};
    service.editRow = editRow;
    console.log(service.edit);
    function editRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/edit-ebmember.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', ebMemberEditController],
            controllerAs: 'ebCtrl',
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
function ebMemberDeleteService($http, $rootScope, $uibModal) {    
    var service = {};
    service.deleteRow = deleteRow;    
    function deleteRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/delete-ebmember.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', ebMemberDeleteController],
            controllerAs: 'ebCtrl',
            size: 'xs',
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
function ebMemberDeleteController($http, $uibModalInstance, grid, row) {
    var ebCtrl = this;    
    ebCtrl.entity = angular.copy(row.entity);
    ebCtrl.deleteRow = deleteRow;

    console.log(row.entity);
    function deleteRow()  {
         $http({
            url: base_url+"deleteEBmember",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            //data : JSON.stringify({"category_id":ebCtrl.entity.category_id,"category_name":ebCtrl.entity.category_name})          
            data: JSON.stringify(ebCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                ebCtrl.server_msg = response.data.message;
                row.entity = angular.extend(row.entity, ebCtrl.entity);
                var i = grid.options.data.indexOf(row.entity);
                grid.options.data.splice(i, 1);

               /* if (response.data.row_id == '0') {
                    grid.data.push(row.entity);

                }                
                angular.forEach(ebCtrl.journals, function(v,i) {
                    if(v.id == row.entity.journal_id) {
                        row.entity.journal_name = v.journal_name;                            
                    }
                });*/
                
                setTimeout(function() {
                    ebCtrl.server_msg = '';
                    $uibModalInstance.close(row.entity);
                },2000);       
            }
        }); 
    }
}

function ebMemberEditController($http, $uibModalInstance, grid, row) {    
    var ebCtrl = this;    
    console.log(ebCtrl);
    ebCtrl.entity = angular.copy(row.entity);
    ebCtrl.save = save;
    function save() {         
    
        $http({
            url: base_url+"update_eb_member",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            //data : JSON.stringify({"category_id":ebCtrl.entity.category_id,"category_name":ebCtrl.entity.category_name})          
            data: JSON.stringify(ebCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                ebCtrl.server_msg = response.data.message;
                row.entity = angular.extend(row.entity, ebCtrl.entity);
                if (response.data.row_id == '0') {
                    grid.data.push(row.entity);

                }                
                angular.forEach(ebCtrl.journals, function(v,i) {
                    if(v.id == row.entity.journal_id) {
                        row.entity.journal_name = v.journal_name;                            
                    }
                });
                
                setTimeout(function() {
                    ebCtrl.server_msg = '';
                    $uibModalInstance.close(row.entity);
                },1500);       
            }
        }); 
    }

    $http({
        url: base_url+"get_journals",
        method: "POST",
        headers: {'Content-Type': 'application/json'}
    })
    .then(function(response) {            
        if(response.status) { 
            ebCtrl.journals = response.data;
        }
    }); 

    ebCtrl.remove = remove;

    function remove() {
        console.dir(row)
        if (row.entity.id != '0') {
            row.entity = angular.extend(row.entity, ebCtrl.entity);
            var index = grid.appScope.ebCtrl.serviceGrid.data.indexOf(row.entity);
            grid.appScope.ebCtrl.serviceGrid.data.splice(index, 1);
        }
        $uibModalInstance.close(row.entity);
    }

}