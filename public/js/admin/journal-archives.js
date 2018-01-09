app.controller('journalArchiveController', journalArchiveController);
app.controller('journalArchiveEditController', journalArchiveEditController);
app.controller('journalArticleDeleteController', journalArticleDeleteController);
app.service('journalarticleEditService', journalarticleEditService);
app.service('journalarticleDeleteService', journalarticleDeleteService);

journalArchiveController.$inject = ['$scope', '$http', '$uibModal', 'journalarticleEditService','journalarticleDeleteService', 'uiGridConstants'];

function journalArchiveController($scope, $http, $uibModal, journalarticleEditService,journalarticleDeleteService, uiGridConstants,$rootScope) {
    var journalArchiveCtrl = this;
        journalArchiveCtrl.spinner = true;
    journalArchiveCtrl.editRow = journalarticleEditService.editRow;
    journalArchiveCtrl.deleteRow = journalarticleDeleteService.deleteRow;

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
            enableCellEdit: false,
            width: 300
        },
        {
            field: 'article_title',
            enableSorting: true,
            enableCellEdit: false,
            width: 200
        },
        {
            field: 'article_link',
            enableSorting: true,
            enableCellEdit: false,
            width: 120
        },
        {
            field: 'article_authors',
            enableSorting: true,
            enableCellEdit: false,
            width: 120
        },
        {
            field: 'volume_name',
            enableSorting: true,
            enableCellEdit: false,
            width:120,
            displayName: "volume"
        },
        {
            field: 'archive_year',
            enableSorting: true,
            enableCellEdit: false,
            width: 105
        },
        {
            field: 'archive_type',
            enableSorting: true,
            enableCellEdit: false,
            cellTemplate: '<div class="ui-grid-cell-contents"><div ng-show="{{row.entity.article_type == 1}}">Review Article</div><div ng-show="{{row.entity.article_type == 2}}">Research Article</div><div ng-show="{{row.entity.article_type == 3}}">Supplementary Information</div></div>',            
            width:120
        },
        {
            field: 'archive_in',
            enableSorting: true,
            enableCellEdit: false,   
            cellTemplate: '<div class="ui-grid-cell-contents"><div ng-show="{{row.entity.archive_in == 1}}">Article In Press</div><div ng-show="{{row.entity.archive_in == 2}}">Current Issue</div><div ng-show="{{row.entity.archive_in == 3}}">Archive</div><div ng-show="{{row.entity.archive_in == 4}}">Special Issues</div></div>',
            width:110            
        },
        {
            field: 'archive_fulltext',
            enableSorting: true,
            enableCellEdit: false,
            cellTemplate: '<div class="ui-grid-cell-contents"><a href="http://www.opensciencepublications.com/fulltextarticles/{{row.entity.archive_fulltext}}" target="_blank">{{row.entity.archive_fulltext}}</a></div>',
            width: 120
        },
        {
            field: 'archive_pdf',
            enableSorting: true,
            enableCellEdit: false,
            cellTemplate: '<div class="ui-grid-cell-contents"><a href="http://www.opensciencepublications.com/wp-content/{{row.entity.archive_pdf}}" target="_blank">{{row.entity.archive_pdf}}</a></div>',
            width: 120
        },
        {
            field: 'supli_pdf',
            enableSorting: true,
            enableCellEdit: false,
            cellTemplate: '<div class="ui-grid-cell-contents"><a href="http://www.opensciencepublications.com/wp-content/{{row.entity.supli_pdf}}" target="_blank">{{row.entity.supli_pdf}}</a></div>',
            width: 120
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,   
            cellTemplate: '<a ng-click=\"grid.appScope.journalArchiveCtrl.editRow(grid, row)\" class="modify-icon">Edit</a>',
            width: 60
        },
        {            
            field: 'id',
            displayName: '', 
            enableSorting: false,   
            cellTemplate: '<a ng-click=\"grid.appScope.journalArchiveCtrl.deleteRow(grid, row)\" class="modify-icon">Delete</a>',
            width: 60
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
        },2000);
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

journalarticleEditService.$inject = ['$http', '$rootScope', '$uibModal'];
journalarticleDeleteService.$inject = ['$http', '$rootScope', '$uibModal'];

function journalarticleEditService($http, $rootScope, $uibModal) {
   
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
function journalarticleDeleteService($http, $rootScope, $uibModal) {    
    var service = {};
    service.deleteRow = deleteRow;    
    function deleteRow(grid, row) {
        $uibModal.open({
            templateUrl: base_url + 'public/angular-templates/delete-journal-article.html',
            controller: ['$http', '$uibModalInstance', 'grid', 'row', journalArticleDeleteController],
            controllerAs: 'journalArchiveCtrl',
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
function journalArticleDeleteController ($http, $uibModalInstance, grid, row) {
    var journalArchiveCtrl = this;    
    journalArchiveCtrl.entity = angular.copy(row.entity);
    journalArchiveCtrl.deleteRow = deleteRow;

    function deleteRow()  {
         $http({
            url: base_url+"deleteJournalArchive",
            method: "POST",
            headers: {'Content-Type': 'application/json'},            
            data: JSON.stringify(journalArchiveCtrl.entity),
        })
        .then(function(response) {            
            if(response.status) {                
                console.log(response);
                journalArchiveCtrl.server_msg = response.data.message;
                row.entity = angular.extend(row.entity, journalArchiveCtrl.entity);
                var i = grid.options.data.indexOf(row.entity);
                grid.options.data.splice(i, 1);
                
                setTimeout(function() {
                    journalArchiveCtrl.server_msg = '';
                    $uibModalInstance.close(row.entity);
                },2000);       
            }
        }); 
    }
}

function journalArchiveEditController($http, $uibModalInstance, grid, row) {
    var journalArchiveCtrl = this;    
    console.log(journalArchiveCtrl);
    journalArchiveCtrl.entity = angular.copy(row.entity);
    journalArchiveCtrl.save = save;
    journalArchiveCtrl.archive_in = [{"id":"1","name":"Article In Press"},{"id":"2","name":"Current Issue"},{"id":"3","name":"Archive"},{"id":"4","name":"Special Issues"}];
    journalArchiveCtrl.article_type = [{"id":"1","name":"Review Article"},{"id":"2","name":"Research Article"},{"id":"3","name":"Supplementary Information"}];
    $http({
        url: base_url+'get_journals_volumes',
        method: "POST"        
    })
    .then(function(response) {        
        journalArchiveCtrl.journal_volumes = response.data;        
    });

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
                if (response.data.add_type == 'add') {
                    row.entity.id = response.data.row_id;
                    grid.data.push(row.entity);

                }                
                angular.forEach(journalArchiveCtrl.journals, function(v,i) {
                    if(v.id == row.entity.journal_id) {
                        row.entity.journal_name = v.journal_name;                            
                    }
                });                
                angular.forEach(journalArchiveCtrl.journal_volumes, function(v,i) {
                    console.log(row.entity.archive_volume);
                    if(v.id == row.entity.archive_volume) {                        
                        row.entity.volume_name = v.volume_name;                            
                    }
                });

/*                angular.forEach(journalArchiveCtrl.article_type, function(v,i) {
                    if(v.id == row.entity.article_type) {
                        row.entity.article_type = v.name;                            
                    }
                });*/
                
                setTimeout(function() {
                    journalArchiveCtrl.server_msg = '';
                    $uibModalInstance.close(row.entity);
                },1500);       
            }
        }); 
    }
        
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