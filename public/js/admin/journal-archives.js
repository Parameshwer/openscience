app.controller('journalArchiveController', journalArchiveController);
app.controller('journalArchiveEditController', journalArchiveEditController);
app.service('journalPostService', journalPostService);

journalArchiveController.$inject = ['$scope', '$http', '$uibModal', 'journalPostService', 'uiGridConstants'];

function journalArchiveController($scope, $http, $uibModal, journalPostService, uiGridConstants,$rootScope) {
    var journalArchiveCtrl = this;
        journalArchiveCtrl.spinner = true;
    journalArchiveCtrl.editRow = journalPostService.editRow;

    journalArchiveCtrl.serviceGrid = {
        enableRowSelection: true,
        enableRowHeaderSelection: false,
        multiSelect: false,
        enableSorting: true,
        enableColumnMenus: false,
        virtualizationThreshold: 75
    };

    journalArchiveCtrl.serviceGrid.columnDefs = [
        {
            field: 'journal_name',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'article_title',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'archive_volume',
            enableSorting: true,
            enableCellEdit: false
        },
        {
            field: 'archive_in',
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
            cellTemplate: '<a ng-click=\"grid.appScope.journalArchiveCtrl.editRow(grid, row)\" class="modify-icon">Edit</a>'
        }
    ];

    /*$http.get('data.json').success(function(response) {
      journalArchiveCtrl.serviceGrid.data = response;
    });*/
    getJournalArchives("");

    function getJournalArchives(search_value) {
        $http({
            url: base_url + 'get_journal_archives',
            method: "POST",
            data : JSON.stringify({"search_value":search_value}) 
        })
        .then(function(response) {
            console.log(response);
            if(response) {
                journalArchiveCtrl.spinner = false;                
                journalArchiveCtrl.serviceGrid.data = response.data;
            }
        });
        //$rootScope.journals = {};
       
        
    }    
    
    journalArchiveCtrl.getTableHeight = function() {           
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    journalArchiveCtrl.searchGrid = function(search_value) {
        journalArchiveCtrl.spinner = true; 
        setTimeout(function() {
            getJournalArchives(search_value);            
        },1000);
    }

    journalArchiveCtrl.addJournalArchive = function() {
        var date = new Date();
        var newService = {
            "id": "0"            
        };
        var rowTmp = {};
        rowTmp.entity = newService;
        journalArchiveCtrl.editRow($scope.journalArchiveCtrl.serviceGrid, rowTmp);
    };

}

journalPostService.$inject = ['$http', '$rootScope', '$uibModal'];

function journalPostService($http, $rootScope, $uibModal) {
   
    var service = {};
    service.editRow = editRow;
    console.log(service.edit);
    function editRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/edit-archive-form.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', journalArchiveEditController],
            controllerAs: 'journalArchiveCtrl',
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

function journalArchiveEditController($http, $uibModalInstance, grid, row) {
    var journalArchiveCtrl = this;    
    console.log(journalArchiveCtrl);
    journalArchiveCtrl.entity = angular.copy(row.entity);
    journalArchiveCtrl.save = save;
    function save() {         
    
        $http({
            url: base_url+"update_archive",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            //data : JSON.stringify({"category_id":journalArchiveCtrl.entity.category_id,"category_name":journalArchiveCtrl.entity.category_name})          
            data: JSON.stringify(journalArchiveCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                journalArchiveCtrl.server_msg = response.data.message;
                row.entity = angular.extend(row.entity, journalArchiveCtrl.entity);
                if (response.data.row_id == '0') {
                    grid.data.push(row.entity);

                }                
                angular.forEach(journalArchiveCtrl.journals, function(v,i) {
                    if(v.id == row.entity.journal_id) {
                        row.entity.journal_name = v.journal_name;                            
                    }
                });
                angular.forEach(journalArchiveCtrl.journal_volumes, function(v,i) {
                    if(v.id == row.entity.archive_volume) {
                        row.entity.archive_volume = v.volume_name;                            
                    }
                });
                angular.forEach(journalArchiveCtrl.archive_type, function(v,i) {
                    if(v.id == row.entity.archive_in) {
                        row.entity.archive_in = v.name;                            
                    }
                });
                
                setTimeout(function() {
                    journalArchiveCtrl.server_msg = '';
                    $uibModalInstance.close(row.entity);
                },1500);       
            }
        }); 
    }
    
    journalArchiveCtrl.archive_type = [{"id":"1","name":"Article In Press"},{"id":"2","name":"Current Issue"},{"id":"3","name":"Archive"},{"id":"4","name":"Special Issues"}];
    journalArchiveCtrl.article_type = [{"id":"1","name":"Review Article"},{"id":"2","name":"Research Article"},{"id":"3","name":"Supplementary Information"}];
    var archive_years = [];
    for (var i = 2000; i <=  2020 ; i++) {
        archive_years.push(i);
    }
    journalArchiveCtrl.archive_years = archive_years;    

    $http({
        url: base_url+"get_journals",
        method: "POST",
        headers: {'Content-Type': 'application/json'}
    })
    .then(function(response) {            
        if(response.status) { 
            journalArchiveCtrl.journals = response.data;
        }
    }); 
    $http({
        url: base_url+'get_journals_volumes',
        method: "POST"        
    })
    .then(function(response) {        
        journalArchiveCtrl.journal_volumes = response.data;        
    });
    journalArchiveCtrl.remove = remove;

    function remove() {
        console.dir(row)
        if (row.entity.id != '0') {
            row.entity = angular.extend(row.entity, journalArchiveCtrl.entity);
            var index = grid.appScope.journalArchiveCtrl.serviceGrid.data.indexOf(row.entity);
            grid.appScope.journalArchiveCtrl.serviceGrid.data.splice(index, 1);
        }
        $uibModalInstance.close(row.entity);
    }

}