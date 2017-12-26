app.controller('journalPostController', journalPostController);
app.controller('journalPostEditController', journalPostEditController);
app.service('journalPostService', journalPostService);

journalPostController.$inject = ['$scope', '$http', '$uibModal', 'journalPostService', 'uiGridConstants'];

function journalPostController($scope, $http, $uibModal, journalPostService, uiGridConstants,$rootScope) {
    var journalPostCtrl = this;
        journalPostCtrl.spinner = true;
    journalPostCtrl.editRow = journalPostService.editRow;

    journalPostCtrl.serviceGrid = {
        enableRowSelection: true,
        enableRowHeaderSelection: false,
        multiSelect: false,
        enableSorting: true,
        enableColumnMenus: false,
        virtualizationThreshold: 250
    };

    journalPostCtrl.serviceGrid.columnDefs = [
        {
            field: 'post_name',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'post_slug',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'journal_name',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'post_content',
            enableSorting: true,
            enableCellEdit: false,
            width: 250
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,   
            cellTemplate: '<a ng-click=\"grid.appScope.journalPostCtrl.editRow(grid, row)\" class="modify-icon">Edit</a>'
        }
    ];

    /*$http.get('data.json').success(function(response) {
      journalPostCtrl.serviceGrid.data = response;
    });*/
    getJournalPosts("");

    function getJournalPosts(search_value) {
        $http({
            url: base_url + 'get_journal_posts',
            method: "POST",
            data : JSON.stringify({"search_value":search_value}) 
        })
        .then(function(response) {
            console.log(response);
            if(response) {
                journalPostCtrl.spinner = false;                
                journalPostCtrl.serviceGrid.data = response.data;
            }
        });
        //$rootScope.journals = {};
       
        
    }

    
    journalPostCtrl.getTableHeight = function() {           
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    journalPostCtrl.searchGrid = function(search_value) {
        journalPostCtrl.spinner = true; 
        setTimeout(function() {
            getJournalPosts(search_value);            
        },1000);
    }

    journalPostCtrl.addJournalPost = function() {
        var date = new Date();
        var newService = {
            "id": "0"            
        };
        var rowTmp = {};
        rowTmp.entity = newService;
        journalPostCtrl.editRow($scope.journalPostCtrl.serviceGrid, rowTmp);
    };

}

journalPostService.$inject = ['$http', '$rootScope', '$uibModal'];

function journalPostService($http, $rootScope, $uibModal) {
   
    var service = {};
    service.editRow = editRow;
    console.log(service.edit);
    function editRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/edit-journal-page.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', journalPostEditController],
            controllerAs: 'journalPostCtrl',
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

function journalPostEditController($http, $uibModalInstance, grid, row) {
    var journalPostCtrl = this;    
    console.log(journalPostCtrl);
    journalPostCtrl.entity = angular.copy(row.entity);
    journalPostCtrl.save = save;
    function save() {         
    
        $http({
            url: base_url+"update_journal_page",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            //data : JSON.stringify({"category_id":journalPostCtrl.entity.category_id,"category_name":journalPostCtrl.entity.category_name})          
            data: JSON.stringify(journalPostCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                journalPostCtrl.server_msg = response.data.message;
                row.entity = angular.extend(row.entity, journalPostCtrl.entity);
                if (response.data.row_id == '0') {
                    grid.data.push(row.entity);

                }                
                angular.forEach(journalPostCtrl.journals, function(v,i) {
                    if(v.id == row.entity.journal_id) {
                        row.entity.journal_name = v.journal_name;                            
                    }
                });
                
                setTimeout(function() {
                    journalPostCtrl.server_msg = '';
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
            journalPostCtrl.journals = response.data;
        }
    }); 

    journalPostCtrl.remove = remove;

    function remove() {
        console.dir(row)
        if (row.entity.id != '0') {
            row.entity = angular.extend(row.entity, journalPostCtrl.entity);
            var index = grid.appScope.journalPostCtrl.serviceGrid.data.indexOf(row.entity);
            grid.appScope.journalPostCtrl.serviceGrid.data.splice(index, 1);
        }
        $uibModalInstance.close(row.entity);
    }

}