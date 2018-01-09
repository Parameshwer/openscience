app.controller('latestArticleController', latestArticleController);
app.controller('latestArticleEditController', latestArticleEditController);
app.controller('latestArticleDeleteController', latestArticleDeleteController);
app.service('latestArticleEditService', latestArticleEditService);
app.service('latestArticleDeleteService', latestArticleDeleteService);

latestArticleController.$inject = ['$scope', '$http', '$uibModal', 'latestArticleEditService','latestArticleDeleteService', 'uiGridConstants'];

function latestArticleController($scope, $http, $uibModal, latestArticleEditService,latestArticleDeleteService, uiGridConstants,$rootScope) {
    var latestArticleCtrl = this;
        latestArticleCtrl.spinner = true;
    latestArticleCtrl.editRow = latestArticleEditService.editRow;
    latestArticleCtrl.deleteRow = latestArticleDeleteService.deleteRow;

    latestArticleCtrl.serviceGrid = {
        enableRowSelection: true,
        enableRowHeaderSelection: false,
        multiSelect: false,
        enableSorting: true,
        enableColumnMenus: false,
        virtualizationThreshold: 75
    };

    latestArticleCtrl.serviceGrid.columnDefs = [
        {
            field: 'article_name',
            enableSorting: true,
            enableCellEdit: false,
            width: 300
        },
        {
            field: 'journal_name',
            enableSorting: true,
            enableCellEdit: false,
            width: 200
        },
        {
            field: 'article_image',
            enableSorting: true,
            enableCellEdit: false,
            width: 120
        },
        {
            field: 'author_name',
            enableSorting: true,
            enableCellEdit: false
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,   
            cellTemplate: '<a ng-click=\"grid.appScope.latestArticleCtrl.editRow(grid, row)\" class="modify-icon">Edit</a>'
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,   
            cellTemplate: '<a ng-click=\"grid.appScope.latestArticleCtrl.deleteRow(grid, row)\" class="modify-icon">Delete</a>'
        }
    ];

    /*$http.get('data.json').success(function(response) {
      latestArticleCtrl.serviceGrid.data = response;
    });*/
    getJournalArchives("");

    function getJournalArchives(search_value) {
        $http({
            url: base_url + 'get_LatestArticles',
            method: "POST",
            data : JSON.stringify({"search_value":search_value}) 
        })
        .then(function(response) {
            console.log(response);
            if(response) {
                latestArticleCtrl.spinner = false;                
                latestArticleCtrl.serviceGrid.data = response.data;
            }
        });
        //$rootScope.journals = {};
       
        
    }    
    
    latestArticleCtrl.getTableHeight = function() {           
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    latestArticleCtrl.searchGrid = function(search_value) {
        latestArticleCtrl.spinner = true; 
        setTimeout(function() {
            getJournalArchives(search_value);            
        },2000);
    }

    latestArticleCtrl.addJournalArchive = function() {
        var date = new Date();
        var newService = {
            "id": "0"            
        };
        var rowTmp = {};
        rowTmp.entity = newService;
        latestArticleCtrl.editRow($scope.latestArticleCtrl.serviceGrid, rowTmp);
    };

}

latestArticleEditService.$inject = ['$http', '$rootScope', '$uibModal'];
latestArticleDeleteService.$inject = ['$http', '$rootScope', '$uibModal'];

function latestArticleEditService($http, $rootScope, $uibModal) {
   
    var service = {};
    service.editRow = editRow;
    console.log(service.edit);
    function editRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/edit-latest-article.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', latestArticleEditController],
            controllerAs: 'latestArticleCtrl',
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
function latestArticleDeleteService($http, $rootScope, $uibModal) {    
    var service = {};
    service.deleteRow = deleteRow;    
    function deleteRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/delete-journal-article.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', latestArticleDeleteController],
            controllerAs: 'latestArticleCtrl',
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
function latestArticleDeleteController ($http, $uibModalInstance, grid, row) {
    var latestArticleCtrl = this;    
    latestArticleCtrl.entity = angular.copy(row.entity);
    latestArticleCtrl.deleteRow = deleteRow;

    function deleteRow()  {
         $http({
            url: base_url+"deleteJournalArchive",
            method: "POST",
            headers: {'Content-Type': 'application/json'},            
            data: JSON.stringify(latestArticleCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                latestArticleCtrl.server_msg = response.data.message;
                row.entity = angular.extend(row.entity, latestArticleCtrl.entity);
                var i = grid.options.data.indexOf(row.entity);
                grid.options.data.splice(i, 1);
                
                setTimeout(function() {
                    latestArticleCtrl.server_msg = '';
                    $uibModalInstance.close(row.entity);
                },2000);       
            }
        }); 
    }
}

function latestArticleEditController($http, $uibModalInstance, grid, row) {
    var latestArticleCtrl = this;    
    console.log(latestArticleCtrl);
    latestArticleCtrl.entity = angular.copy(row.entity);
    latestArticleCtrl.save = save;    

    function save() {         
    
        $http({
            url: base_url+"update_latest_article",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            //data : JSON.stringify({"category_id":latestArticleCtrl.entity.category_id,"category_name":latestArticleCtrl.entity.category_name})          
            data: JSON.stringify(latestArticleCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                latestArticleCtrl.server_msg = response.data.message;
                row.entity = angular.extend(row.entity, latestArticleCtrl.entity);
                if (response.data.add_type == 'add') {
                    row.entity.id = response.data.row_id;
                    grid.data.push(row.entity);

                }                
                angular.forEach(latestArticleCtrl.journals, function(v,i) {
                    if(v.id == row.entity.journal_id) {
                        row.entity.article_category = v.journal_name;                            
                    }
                });                


/*                angular.forEach(latestArticleCtrl.article_type, function(v,i) {
                    if(v.id == row.entity.article_type) {
                        row.entity.article_type = v.name;                            
                    }
                });*/
                
                setTimeout(function() {
                    latestArticleCtrl.server_msg = '';
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
            latestArticleCtrl.journals = response.data;
        }
    }); 
  
    latestArticleCtrl.remove = remove;

    function remove() {
        console.dir(row)
        if (row.entity.id != '0') {
            row.entity = angular.extend(row.entity, latestArticleCtrl.entity);
            var index = grid.appScope.latestArticleCtrl.serviceGrid.data.indexOf(row.entity);
            grid.appScope.latestArticleCtrl.serviceGrid.data.splice(index, 1);
        }
        $uibModalInstance.close(row.entity);
    }

}