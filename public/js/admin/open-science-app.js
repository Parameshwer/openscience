app.controller('editMaincategoryController', function($scope,$rootScope,$routeParams,$location,factory,main_category) {        
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

app.controller('EditHomeLatestUpdateController', function($scope,$rootScope,$routeParams,$location,factory,latest_home_update){        
    var latest_u_id = ($routeParams.updateID) ? parseInt($routeParams.updateID) : 0;
    $rootScope.title = (latest_u_id > 0) ? 'Edit Update' : 'Add Update';
    $scope.buttonText = (latest_u_id > 0) ? 'Edit Update' : 'Add Update';    
    var original = latest_home_update.data[0];    
    $scope.latest_home_update = original;
    $scope.saveLatestUpdate = function(latest_home_update) {
        $scope.server_msg = 'Details are saving....';
        if (latest_u_id <= 0) {
            factory.updateLatestUpdate("0",latest_home_update,$scope);            
        }
        else {
            factory.updateLatestUpdate(latest_u_id, latest_home_update,$scope);
        }
    }
});

app.controller('EditJournalController', function($scope,Upload,$timeout,$rootScope,$routeParams,$location,factory,main_journal) { 
    var journal_id = ($routeParams.journal_id) ? parseInt($routeParams.journal_id) : 0;
    $rootScope.title = (journal_id > 0) ? 'Edit Journal' : 'Add Journal';
    $scope.buttonText = (journal_id > 0) ? 'Update Journal' : 'Add New Journal';    
    var original = main_journal.data[0];    
    $scope.main_journal = original;
    //$scope.options = [{ name: "Medical", id: 10 }, { name: "Biotechnolgy", id: 20 },{ name: "Pharmaseutical", id: 30 },{ name: "Biology", id: 40 }];
    //$scope.selectedOption = $scope.options[1];
    $scope.isClean = function() {
       return angular.equals(original, $scope.main_journal);
    }
    $scope.convertToJournalSlug = function(elem) {
        //$('#journal_url_slug').val(elem.main_journal.journal_name.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-'));         
    }
    $scope.saveJournal = function(main_journal) {
        $scope.server_msg = 'Details are saving....';
        if (journal_id <= 0) {
            factory.updateJournal(0,main_journal,$scope);
        }
        else {
            factory.updateJournal(journal_id, main_journal,$scope);
        }
    }
    $scope.uploadImage = function(file) {
        if(file) {
            factory.saveUploadedImage(journal_id, file);
        }
    }
    $scope.uploadPic = function(file) {
        file.upload = Upload.upload({
          url: base_url+'admin/save_uploaded_file',
          data: {file: file},
        });

        file.upload.then(function (response) {
          $timeout(function () {
            file.result = response.data;
          });
        }, function (response) {
          if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
          // Math.min is to fix IE which reports 200% sometimes
          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    }
});
app.controller('EditJournalPageController', function($scope,$rootScope,$routeParams,$location,factory,main_page) { 

    var page_id = ($routeParams.pageID) ? parseInt($routeParams.pageID) : 0;
    $rootScope.title = (page_id > 0) ? 'Edit Journal Page' : 'Add Journal Page';
    $scope.buttonText = (page_id > 0) ? 'Update Journal Page' : 'Add New Journal Page';    
    var original = main_page.data.post_info;
    
    if(page_id == 0) {
        original.post_content = '';
    }
    $scope.main_page = original[0];
    $scope.journal_info = main_page.data.journal_info;    
    //$scope.options = [{ name: "Medical", id: 10 }, { name: "Biotechnolgy", id: 20 },{ name: "Pharmaseutical", id: 30 },{ name: "Biology", id: 40 }];
    //$scope.selectedOption = $scope.options[1];
    $scope.isClean = function() {
       return angular.equals(original, $scope.main_page);
    }
    $scope.saveJournalPage = function(main_page) {                
         $scope.server_msg = 'Details are saving....';
        if (page_id <= 0) {            
            factory.updateJournalPage(0,main_page,$scope);
        }
        else {
            factory.updateJournalPage(page_id, main_page,$scope);
        }
    }
    /*$scope.tinymceOptions = {
        onChange: function(e) {
          // put logic here for keypress and cut/paste changes
        },
        inline: false,
        plugins : 'advlist autolink link image lists charmap print preview link media',
        skin: 'lightgray',
        theme : 'modern',
        width : 600,
        height : 300
      };*/
    $scope.convertToPostSlug = function(elem) {        
        //$('#journal_post_slug').val(elem.main_page.post_name.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-'));         
    };
    $scope.convertToJournalSlug = function(elem) {        
       /* $.each($scope.journal_info,function(i,v){
            if(v.id == elem){                
                    $('#journal_slug').val(v.journal_name.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-'));                            
            }
        });*/        

    };
});

app.controller('wysiwygeditor', ['$scope', 'textAngularManager', function wysiwygeditor($scope, textAngularManager) {
    $scope.version = textAngularManager.getVersion();
    $scope.versionNumber = $scope.version.substring(1);
    $scope.orightml = '';
    $scope.htmlcontent = $scope.orightml;
    $scope.disabled = false;
}]);

app.controller('EditLatestArticleController', function($scope,$rootScope,$routeParams,$location,factory,latest_articles){        
   var article_id = ($routeParams.ArchiveId) ? parseInt($routeParams.ArchiveId) : 0;
    $rootScope.title = (article_id > 0) ? 'Edit Latest Article' : 'Add Latest Article';
    $scope.buttonText = (article_id > 0) ? 'Update Latest Article' : 'Add New Latest Article';

    $scope.latest_article = latest_articles.data.article_info[0];
    $scope.journal_info = latest_articles.data.journal_info;

    $scope.saveLatestArticle = function(latest_article) {
        $scope.server_msg = 'Details are saving....';
        if (article_id <= 0) {            
            factory.updateLatestArticle(0,latest_article,$scope);
        }
        else {
            factory.updateLatestArticle(archive_id, latest_article,$scope);
        }
    }
});
app.controller('EditTestimonialController', function($scope,$rootScope,$routeParams,$location,factory,testimonials){        
   var article_id = ($routeParams.ArchiveId) ? parseInt($routeParams.ArchiveId) : 0;
    $rootScope.title = (article_id > 0) ? 'Edit Testimonials' : 'Add Testimonials';
    $scope.buttonText = (article_id > 0) ? 'Update Testimonials' : 'Add New Testimonials';

    $scope.testimonial = testimonials.data[0];

    $scope.saveTestimonial = function(testimonials) {                        
        $scope.server_msg = 'Details are saving....';
        if (article_id <= 0) {            
            factory.updateTestimonial(0,testimonials,$scope);
        }
        else {
            factory.updateTestimonial(archive_id, testimonials,$scope);
        }
    }
});
app.controller('EditSupliTypeController', function($scope,$rootScope,$routeParams,$location,factory,suplitypes){        
   var sid = ($routeParams.sid) ? parseInt($routeParams.sid) : 0;
    $rootScope.title = (sid > 0) ? 'Edit Suplitype' : 'Add Suplitype';
    $scope.buttonText = (sid > 0) ? 'Update Suplitype' : 'Add New Suplitype';        

    $scope.saveJournalVolume = function(journal_volumes) {        
        if (sid <= 0) {            
            factory.updateJournalVolume(0,journal_volumes,$scope);
        }
        else {
            factory.updateJournalVolume(sid, journal_volumes,$scope);
        }
    }
});
app.controller('EditJournalArchiveController', function($scope,$rootScope,$routeParams,$location,factory,archive,$http) {     
    var archive_id = ($routeParams.ArchiveId) ? parseInt($routeParams.ArchiveId) : 0;
    $rootScope.title = (archive_id > 0) ? 'Edit Journal Archive' : 'Add Journal Archive';
    $scope.buttonText = (archive_id > 0) ? 'Update Journal Archive' : 'Add New Journal Archive';    
    var archive_years = [];
    for (var i = 2000; i <=  2020 ; i++) {
        archive_years.push(i);
    }
    console.log(archive.data);
    var original = archive.data.archive_info;
    $scope.archive_info = original[0];        
    $scope.journal_info = archive.data.journal_info;  
    //$scope.volumes_arr = [{"id":"volume-1-issue-1","name":"volume 1 issue 1"},{"id":"volume-1-issue-2","name":"volume 1 issue 2"},{"id":"volume-2-issue-1","name":"volume 2 issue 1"},{"id":"volume-2-issue-2","name":"volume 2 issue 2"},{"id":"volume-3-issue-1","name":"volume 3 issue 1"},{"id":"volume-3-issue-2","name":"volume 3 issue 2"},{"id":"volume-4-issue-1","name":"volume 4 issue 1"},{"id":"volume-4-issue-2","name":"volume 4 issue 2"}];    
    $scope.volumes_arr  = archive.data.volume_info;
    /*$scope.volumes_arr = [
                        {"id":"volume-1-issue-1","name":"volume 1 issue 1"},
                        {"id":"volume-1-issue-2","name":"volume 1 issue 2"},
                        {"id":"volume-1-issue-3","name":"volume 1 issue 3"},
                        {"id":"volume-2-issue-1","name":"volume 2 issue 1"},
                        {"id":"volume-2-issue-2","name":"volume 2 issue 2"},
                        {"id":"volume-2-issue-3","name":"volume 2 issue 3"},
                        {"id":"volume-2-issue-4","name":"volume 2 issue 4"},
                        {"id":"volume-3-issue-1","name":"volume 3 issue 1"},
                        {"id":"volume-3-issue-2","name":"volume 3 issue 2"},
                        {"id":"volume-3-issue-3","name":"volume 3 issue 3"},
                        {"id":"volume-4-issue-1","name":"volume 4 issue 1"},
                        {"id":"volume-4-issue-2","name":"volume 4 issue 2"},
                        {"id":"volume-4-issue-3","name":"volume 4 issue 3"},
                        {"id":"volume-5-issue-1","name":"volume 5 issue 1"},
                        {"id":"volume-5-issue-2","name":"volume 5 issue 2"},
                        {"id":"volume-5-issue-3","name":"volume 5 issue 3"},
                        {"id":"volume-6-issue-1","name":"volume 6 issue 1"},
                        {"id":"volume-6-issue-2","name":"volume 6 issue 2"},
                        {"id":"volume-6-issue-3","name":"volume 6 issue 3"}];    */
    $scope.archive_years = archive_years;
    $scope.archive_type = [{"id":"1","name":"Article In Press"},{"id":"2","name":"Current Issue"},{"id":"3","name":"Archive"},{"id":"4","name":"Special Issues"}]

    $scope.tinymceOptions = {
        onChange: function(e) {
          // put logic here for keypress and cut/paste changes
        },
        inline: false,
        plugins : 'advlist autolink link image lists charmap print preview link media',
        skin: 'lightgray',
        theme : 'modern',
        width : 600,
        height : 300
      };

    $scope.convertToJournalSlug = function(elem) {        
        $.each($scope.journal_info,function(i,v){
            if(v.id == elem){                
                    $('#journal_slug').val(v.journal_name.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-'));                            
            }
        });        

    };
    $scope.saveJournalArchive = function(archive_info) {                
        $scope.server_msg = 'Details are saving....';
        if (archive_id <= 0) {            
            factory.updateJournalArchive(0,archive_info,$scope);
        }
        else {
            factory.updateJournalArchive(archive_id, archive_info,$scope);
        }
    };
 $scope.temp = function() {        
        $http({
            url: base_url+'admin/get_supli_type_by_journal',
            method: "POST",
            data: {id:angular.element('#journal_name_select')[0].value}        
        })
        .then(function(response) {
            $scope.supli_arr= response.data;
        });

    }
});

/*app.controller('JournalsController', function($scope,factory) {    
    $http({
        url: base_url+'admin/get_journals',
        method: "POST"        
    })
    .then(function(data) {
        $scope.main_journals = data.data;
        return $scope;
    }); 
});
*/

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
        url: base_url+'admin/dashboard',
        method: "POST"        
    })
    .then(function(response) {
        $scope.count = response.data[0];
        return $scope;
    });    
});
app.controller('UploadFilesToserverController', function($scope,$rootScope,$http,$timeout) {
    $scope.spinner = true; 
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 100,
        virtualizationThreshold: 75,        
        rowHeight:50,
        columnDefs: [
          { name: 'file_name',width:'200'},
          { name: 'full_path' ,width:'400'},
          { name: 'file_type',width:'100'},
          { name: 'image_type',width:'110'},
          { name: 'file_ext',width:'110'},
          { name: 'created_date',width:'150'}
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {       
       return {
          height: (angular.element(window).height() - 450)+'px'
       };
    };    
    getUploadedFiles();

    function getUploadedFiles(search_value) {
        $http({
            url: base_url+'admin/getUploadedFiles',
            method: "POST"
        })
        .then(function(response) {
            $scope.gridOptions1.data = response.data;
             $timeout(function() {
                $scope.spinner= false;
             }, 500);        
        });              
    }   
});
app.controller('JournalsController', function($scope,$rootScope,$http,$timeout){ 
    $scope.spinner = true; 
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 100,
        virtualizationThreshold: 75,        
        rowHeight:50,
        columnDefs: [
          { name: 'journal_name',width:'400'},
          { name: 'issn_number' ,width:'150'},
          { name: 'category_name',width:'150' },          
          { name: 'created_date'},
          { name: 'id',
            displayName: 'Edit',
            cellTemplate: '<a class="modify-icon" href="#/EditJournals/{{COL_FIELD}}">Edit</a>'
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {       
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };
    $scope.searchGrid = function(search_value) {
        $scope.spinner = true; 
        $timeout(function() {
            getJournals(search_value);            
        },1000);
    }

    getJournals();

    function getJournals(search_value) {
        $http({
            url: base_url+'admin/get_journals',
            method: "POST",
            data : JSON.stringify({"search_value":search_value})
        })
        .then(function(response) {
            $scope.gridOptions1.data = response.data;
             $timeout(function() {
                $scope.spinner= false;
             }, 500);        
        });              
    }
});
app.controller('MainCategoriesController', function($scope,$rootScope,$http,$timeout){
    $scope.spinner = true;        
    $scope.gridOptions1 = {
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
            cellTemplate: '<a class="modify-icon" href="#/EditMainCategory/{{COL_FIELD}}">Edit</a>'
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };

    $scope.getTableHeight = function() {       
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };

    $scope.searchGrid = function(search_value) {
        $scope.spinner = true; 
        $timeout(function() {
            getCategories(search_value);            
        },1000);
    }

    getCategories("");

    function getCategories(search_value) {
        $http({
            url: base_url+'admin/get_categories',
            method: "POST",
            data : JSON.stringify({"search_value":search_value})        
        })
        .then(function(response) {        
            $scope.gridOptions1.data = response.data;
             $timeout(function() {
                $scope.spinner= false;
             }, 500);
        });              
    }
});
app.controller('JournalPostsController', function($scope,$rootScope,$http,$timeout,$window) {
        $scope.spinner = true;
        $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 75,
        virtualizationThreshold: 75,
        rowHeight:40,
        columnDefs: [
          { name: 'post_name' ,width:160},
          { name: 'journal_name' ,width:330},
          { name: 'category_name',width:150},          
          { name: 'created_date',width:140},
          { name: 'updated_date',width:130},
          { name: 'id',
            displayName: 'Edit',
            cellTemplate: '<a class="modify-icon" href="#/EditJournalPage/{{COL_FIELD}}">Edit</a>'
          }/*,
          { name: 'Delete',
            cellTemplate: '<a class="modify-icon" ng-click="grid.appScope.deleteRow(row)">Delete</a>'
          }*/
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {
       var rowHeight = 110; // your row height
       var headerHeight = 100; // your header height
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };
    $scope.searchGrid = function(search_value) {
        $scope.spinner = true; 
        $timeout(function() {
            getJournalPosts(search_value);            
        },1000);
    }

    $scope.deleteRow = function(row) {        
     /* var deleteeb_member = $window.confirm('Are you absolutely sure you want to delete?');
          if(deleteeb_member) {
         $http({
            url: base_url+'admin/deleteJournalPost',
            method: "POST",
            data: {id:row.entity.id}
        })
        .then(function(response) {
            if(response.data) {
                var index = $scope.gridOptions1.data.indexOf(row.entity);
                    $scope.gridOptions1.data.splice(index, 1);
            }           
        });       
        }*/
    };
    getJournalPosts();

    function getJournalPosts(search_value) {
        $http({
            url: base_url+'admin/get_journals_posts',
            method: "POST",
            data : JSON.stringify({"search_value":search_value})
        })
        .then(function(response) {                   
            $scope.gridOptions1.data = response.data;
            $timeout(function(){
                $scope.spinner = false;
            },500);
        });        
    }

});

app.controller('NewEbMembersController', function($scope,$rootScope,$http,$window,$timeout){            

    $http({
        url: base_url+'admin/get_only_journals',
        method: "POST"        
    })
    .then(function(response) {
        console.log(response);
        $scope.journals = response.data;
        $scope.journal_posts_archives = [];
        return $scope;
    });

    $scope.GetEbMembers= function(j_info) {
        $scope.spinner = true;       
        $scope.gridOptions1 = {
            paginationPageSizes: [25, 50, 75],
            paginationPageSize: 150,
            virtualizationThreshold: 75,
            rowHeight:110,
            columnDefs: [
              { name: 'category_name' ,width:150},
              { name: 'journal_name',width:160},                
              { name: 'eb_member_name',width:150},
              {
                field: 'eb_member_photo',
                cellTemplate: '<div class="ui-grid-cell-contents"><img src="http://www.avensonline.org/wp-content/uploads/{{ COL_FIELD  }}" /></div>',
                width:150
              },      
              { name: 'eb_member_country', width:180},
              { name: 'editor_chief', width:150},              
              { name: 'eb_post_slug',width:130},
              { name: 'eb_journal_slug',width:150},
              { name: 'updated_date', width:130},
              { name: 'id',
                displayName: 'Edit',
                cellTemplate: '<a class="modify-icon" href="#/EditNewEbmember/{{ COL_FIELD }}"">Edit</a>',width:60
              },
              { name: 'Delete',
                cellTemplate: '<a class="modify-icon" ng-click="grid.appScope.deleteRow(row)">Delete</a>',width:60
              }
            ],
            onRegisterApi: function (gridApi) {
              gridApi.pagination.on.paginationChanged($scope,function(){
                $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
              })
            }
        };
        $scope.getTableHeight = function() {           
           return {
              height: (angular.element(window).height() - 155)+'px'
           };
        };
        $http({
            url: base_url+'admin/get_new_eb_members_by_journal',
            method: "POST",
            data: j_info
        })
        .then(function(response) {            
            $scope.gridOptions1.data = response.data; 
            $scope.spinner = false;
        });        
    };
    $scope.deleteRow = function(row) {        
      var deleteeb_member = $window.confirm('Are you absolutely sure you want to delete?');
          if(deleteeb_member) {
         $http({
            url: base_url+'admin/deleteEBmember',
            method: "POST",
            data: {id:row.entity.id}
        })
        .then(function(response) {
           //$('#eb_members_'+row.entity.id).closest('tr').remove();            
                var index = $scope.gridOptions1.data.indexOf(row.entity);
                    $scope.gridOptions1.data.splice(index, 1);
        });       
        }
    };
});
app.controller('FulltextArticlesController', function($scope,$rootScope,$http,$timeout,$window) {        
    $scope.spinner = true;
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 75,
        virtualizationThreshold: 75,
        rowHeight:110,
        columnDefs: [          
          {
            field: 'post_title',
            cellTemplate: '<div class="ui-grid-cell-contents"><a target="_blank" href="http://www.avensonline.org/fulltextarticles/{{ COL_FIELD  }}.html">{{ COL_FIELD }}</a>',
            width:200
          },
          { name: 'post_meta_keywords' ,width:300},
          { name: 'post_browser_title' ,width:300},
          { name: 'post_modified',width:140},
          { name: 'ID',
            displayName: 'Edit',
            cellTemplate: '<a class="modify-icon" href="#/EditFulltextArticle/{{ COL_FIELD }}">Edit</a>',
            width:60
          },
          { name: 'Delete',
            cellTemplate: '<a class="modify-icon" ng-click="grid.appScope.deleteRow(row)">Delete</a>',width:60
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {
       return {
          height: (angular.element(window).height() - 120)+'px'
       };
    };
    $scope.searchGrid = function(search_value) {
        $scope.spinner = true; 
        $timeout(function() {
            getFulltextArticles(search_value);            
        },1000);
    }
    getFulltextArticles();

    $scope.deleteRow = function(row) {        
      var deleteeb_member = $window.confirm('Are you absolutely sure you want to delete?');
          if(deleteeb_member) {
         $http({
            url: base_url+'admin/deleteFulltextarticle',
            method: "POST",
            data: {id:row.entity.ID}
        })
        .then(function(response) {
            if(response.data) {
                var index = $scope.gridOptions1.data.indexOf(row.entity);
                    $scope.gridOptions1.data.splice(index, 1);
            }           
        });       
        }
    };

    function getFulltextArticles(search_value) {
        $http({
            url: base_url+'admin/get_fulltext_articles',
            method: "POST",
            data : JSON.stringify({"search_value":search_value})
        })
        .then(function(response) {
            //$scope.journal_posts_archives = response.data;
            $scope.gridOptions1.data = response.data; 
            $scope.spinner = false;
        });
        
    }    
});
app.controller('JournalArchiveController', function($scope,$rootScope,$http,$timeout,$window){        
    $http({
        url: base_url+'admin/get_only_journals',
        method: "POST"        
    })
    .then(function(response) {
        $scope.journals = response.data;
        $scope.archive_type = [{"id":"1","name":"Article In Press"},{"id":"2","name":"Current Issue"},{"id":"3","name":"Archive"},{"id":"4","name":"Special Issues"}]
        $scope.journal_posts_archives = [];
        return $scope;
    });
    $scope.GetJournalArchives = function(j_info) {
        $scope.spinner = true;
        $scope.gridOptions1 = {
            paginationPageSizes: [25, 50, 75],
            paginationPageSize: 100,
            rowHeight:40,
            virtualizationThreshold: 75,
            columnDefs: [
              { name: 'journal_name' ,width:330},
              { name: 'category_name',width:150},          
              { name: 'archive_volume',width:140},              
              { name: 'archive_in',
                cellTemplate: '<div>{{COL_FIELD == 3 ? "Archive" : (COL_FIELD == 2 ? "Current Issue" : (COL_FIELD == 1 ? "Article In Press" : "Special Issue"))}}</div>'
              },
              { name: 'archive_year',width:130},
              { name: 'id',
                displayName: 'Edit',
                cellTemplate: '<a class="modify-icon" href="#/EditJournalArchive/{{COL_FIELD}}">Edit</a>'
              },
              { name: 'Delete',
                cellTemplate: '<a class="modify-icon" ng-click="grid.appScope.deleteRow(row)">Delete</a>'
              }
            ],
            onRegisterApi: function (gridApi) {
              gridApi.pagination.on.paginationChanged($scope,function(){
                $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
              })
            }
        };

        $http({
            url: base_url+'admin/get_archives_by_journal',
            method: "POST",
            data: j_info
        })
        .then(function(response) {            
            $scope.gridOptions1.data = response.data; 
            $scope.spinner = false;
        });        
    };
    $scope.deleteRow = function(row) {        
      var deleteeb_member = $window.confirm('Are you absolutely sure you want to delete?');
        if(deleteeb_member) {
             $http({
                url: base_url+'admin/deleteJournalArchive',
                method: "POST",
                data: {id:row.entity.id}
            })
            .then(function(response) {
                if(response.data) {
                    var index = $scope.gridOptions1.data.indexOf(row.entity);
                        $scope.gridOptions1.data.splice(index, 1);
                }           
            });       
        }
    };
    $scope.getTableHeight = function() {       
       return {
          height: (angular.element(window).height() - 155)+'px'
       };
    };
 $scope.tinymceOptions = {
    onChange: function(e) {
      // put logic here for keypress and cut/paste changes
    },
    inline: false,
    plugins : 'advlist autolink link image lists charmap print preview link media',
    skin: 'lightgray',
    theme : 'modern',
    width : 600,
    height : 300
  };
});
app.controller('LatestArticlesController', function($scope,$rootScope,$http,$timeout,$window) {
    $scope.spinner = true;
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 75,
        virtualizationThreshold: 75,
        rowHeight:110,
        columnDefs: [
          { name: 'article_name' ,width:400},
          { name: 'pdf_link',width:200},          
          { name: 'journal_name',width:180},          
          {
            field: 'article_image',
            cellTemplate: '<div class="ui-grid-cell-contents"><img src="http://www.avensonline.org/wp-content/uploads/{{ COL_FIELD  }}" /></div>',
            width:150
          },          
          { name: 'author_name',width:150},
          { name: 'created_date',width:130},
          { name: 'id',
            displayName: 'Edit',
            cellTemplate: '<a class="modify-icon" href="#/EditLatestArticle/{{COL_FIELD}}">Edit</a>',width:60
          },
          { name: 'Delete',
            cellTemplate: '<a class="modify-icon" ng-click="grid.appScope.deleteRow(row)">Delete</a>',width:60
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {      
       return {
          height: (angular.element(window).height() - 119)+'px'
       };
    };
    $scope.deleteRow = function(row) {        
      var deleteeb_member = $window.confirm('Are you absolutely sure you want to delete?');
          if(deleteeb_member) {
         $http({
            url: base_url+'admin/deleteLatestArticle',
            method: "POST",
            data: {id:row.entity.id}
        })
        .then(function(response) {
            if(response.data) {
                var index = $scope.gridOptions1.data.indexOf(row.entity);
                    $scope.gridOptions1.data.splice(index, 1);
            }           
        });       
        }
    };
    $scope.searchGrid = function(search_value) {
        $scope.spinner = true; 
        $timeout(function() {
            getLatestArticles(search_value);            
        },1000);
    }
    getLatestArticles();
    function getLatestArticles(search_value) {
        $http({
            url: base_url+'admin/get_LatestArticles',
            method: "POST",            
            data : JSON.stringify({"search_value":search_value})
        })
        .then(function(response) {        
            $scope.gridOptions1.data = response.data; 
            $scope.spinner = false;
        });            
    }
    
});
app.controller('TestimonialsController', function($scope,$rootScope,$http,$timeout,$window) {
    $scope.spinner = true;
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 75,
        virtualizationThreshold: 75,
        rowHeight:110,
        columnDefs: [
          { name: 'user_name' ,width:150},
          { name: 'testimonial_desc',width:400},                
          {
            field: 'user_img',
            cellTemplate: '<div class="ui-grid-cell-contents"><img src="http://www.avensonline.org/wp-content/uploads/{{ COL_FIELD  }}" /></div>',
            width:150
          },      
          { name: 'user_desig',width:150},
          { name: 'user_university', width:150},
          { name: 'created_date', width:150},
          { name: 'id',
            displayName: 'Edit',
            cellTemplate: '<a class="modify-icon" href="#/EditTestimonial/{{COL_FIELD}}">Edit</a>',width:60
          },
          { name: 'Delete',
            cellTemplate: '<a class="modify-icon" ng-click="grid.appScope.deleteRow(row)">Delete</a>',width:60
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {
       var rowHeight = 110; // your row height
       var headerHeight = 100; // your header height
       return {
          height: (angular.element(window).height() - 119)+'px'
       };
    };

    $scope.deleteRow = function(row) {        
      var deleteeb_member = $window.confirm('Are you absolutely sure you want to delete?');
          if(deleteeb_member) {
         $http({
            url: base_url+'admin/deleteTestimonial',
            method: "POST",
            data: {id:row.entity.id}
        })
        .then(function(response) {
            if(response.data) {
                var index = $scope.gridOptions1.data.indexOf(row.entity);
                    $scope.gridOptions1.data.splice(index, 1);
            }           
        });       
        }
    };

    $http({
        url: base_url+'admin/get_Testimonials',
        method: "POST"
    })
    .then(function(response) {
        //$scope.journal_posts_archives = response.data;
        $scope.gridOptions1.data = response.data; 
        $scope.spinner = false;
    });
});

app.controller('SuplitypeController', function($scope,$rootScope,$http){        
    $http({
        url: base_url+'admin/get_journals_volumes',
        method: "POST"        
    })
    .then(function(response) {        
        $scope.journal_volumes = response.data;
        return $scope;
    });
});

app.controller('SubmitManuscriptController', function($scope,$rootScope,$http){        
    $scope.spinner = true;
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 75,
        virtualizationThreshold: 75,
        rowHeight:50,
        columnDefs: [
          { name: 'created_date' ,width:150},
          { name: 'firstname',width:150},                
          { name: 'email',width:150},
          { name: 'alter_email', width:150},
          { name: 'journal', width:300},
          { name: 'article', width:300},
          { name: 'country', width:180},
          {
            field: 'uploadfile',
            cellTemplate: '<div class="ui-grid-cell-contents"><a href="http://www.avensonline.org/public/images/{{ COL_FIELD  }}">{{ COL_FIELD }}</a></div>',
            width:150
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {
       var rowHeight = 110; // your row height
       var headerHeight = 100; // your header height
       return {
          height: (angular.element(window).height() - 119)+'px'
       };
    };

    $http({
        url: base_url+'admin/get_SubmitManuscript',
        method: "POST"
    })
    .then(function(response) {
        //$scope.journal_posts_archives = response.data;
        $scope.gridOptions1.data = response.data; 
        $scope.spinner = false;
    });
});


app.controller('HomeLatestUpdatesController', function($scope,$rootScope,$http){        
    $scope.spinner = true;
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 75,
        virtualizationThreshold: 75,
        rowHeight:300,
        columnDefs: [          
          { name: 'latest_update_description',width:715},                
          { name: 'created_date',width:150},
          { name: 'updated_date', width:150},
          { name: 'id',
            displayName: 'Edit',
            cellTemplate: '<a class="modify-icon" href="#/EditHomeLatestUpdate/{{COL_FIELD}}">Edit</a>',width:60
          }
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {
       var rowHeight = 110; // your row height
       var headerHeight = 100; // your header height
       return {
          height: (angular.element(window).height() - 119)+'px'
       };
    };

    $http({
        url: base_url+'admin/get_Home_Latest_Updates',
        method: "POST"
    })
    .then(function(response) {
        //$scope.journal_posts_archives = response.data;
        console.log(response.data);
        $scope.gridOptions1.data = response.data; 
        $scope.spinner = false;
    });
});


app.controller('EditFulltextController', function($scope,$rootScope,$routeParams,$location,factory,fulltextArticle){        
   var sid = ($routeParams.sid) ? parseInt($routeParams.sid) : 0;
    $rootScope.title = (sid > 0) ? 'Edit Fulltext' : 'Add Fulltext';
    $scope.buttonText = (sid > 0) ? 'Update Fulltext' : 'Add New Fulltext';    
    
    
    $scope.fulltext_article = fulltextArticle.data.fulltext_info[0];
    $scope.journal_info = fulltextArticle.data.j_info;

    $scope.saveFulltext = function(fulltextArticle) {
    $scope.server_msg = "Details are saving...";                            
        if (sid <= 0) {            
            factory.updateFulltextArticle(0,fulltextArticle,$scope);
        }
        else {
            factory.updateFulltextArticle(sid, fulltextArticle,$scope);
        }
    }
});

app.controller('CollaborationsController', function($scope,$rootScope,$http){        
   $scope.spinner = true;
    $scope.gridOptions1 = {
        paginationPageSizes: [25, 50, 75],
        paginationPageSize: 75,
        virtualizationThreshold: 75,
        rowHeight:80,
        columnDefs: [
          { name: 'contact_person' ,width:150},
          { name: 'email',width:400},                
          { name: 'univer_name',width:150},
          { name: 'mail_address', width:150},
          { name: 'country', width:150},
          { name: 'telephone', width:150},
          { name: 'website_url', width:150},
          { name: 'mem_univer_dept', width:150},
          { name: 'created_date', width:150}
        ],
        onRegisterApi: function (gridApi) {
          gridApi.pagination.on.paginationChanged($scope,function(){
            $scope.gridOptions.virtualizationThreshold =  $scope.gridOptions.paginationPageSize;
          })
        }
    };
    $scope.getTableHeight = function() {
       var rowHeight = 110; // your row height
       var headerHeight = 100; // your header height
       return {
          height: (angular.element(window).height() - 119)+'px'
       };
    };

    $http({
        url: base_url+'admin/get_Collaborations',
        method: "POST"
    })
    .then(function(response) {
        //$scope.journal_posts_archives = response.data;
        $scope.gridOptions1.data = response.data; 
        $scope.spinner = false;
    });
});
app.controller('EditEbMemberController', function($scope,$rootScope,$routeParams,$location,factory,eb_member) { 

    var page_id = ($routeParams.pageID) ? parseInt($routeParams.pageID) : 0;
    $rootScope.title = (page_id > 0) ? 'Edit Eb Member' : 'Add Eb Member';
    $scope.buttonText = (page_id > 0) ? 'Update Eb Member' : 'Add New Eb Member';    
    console.log(eb_member);
    var original = eb_member.data.eb_info;
    
    if(page_id == 0) {
        original.post_content = '';
    }
    $scope.eb_member = original[0];
    $scope.journal_info = eb_member.data.journal_info;

    $scope.isClean = function() {
       return angular.equals(original, $scope.eb_member);
    }
    $scope.saveEbMember = function(eb_member) {
        $scope.server_msg = 'Details are saving....';
        if (page_id <= 0) {            
            factory.updateEbMember(0,eb_member,$scope);
        }
        else {
            factory.updateEbMember(page_id, eb_member,$scope);
        }
    }
   
});

app.directive("globalFileUpload", function() {    
return {
        restrict : "A",        
        link: function($scope, element, attrs) {

            if(attrs.id == 'global-file-upload-latest-article' || attrs.id == 'global-file-upload-testimonial' || attrs.id == 'global-file-upload-eb-member') {
                var extn_arr = ['png','jpeg','jpg','gif'];
            } else if(attrs.id == 'global-file-upload-s-pdf' || attrs.id == 'global-file-upload-archive-pdf') {
                var extn_arr = ['pdf'];
            }
        var uploader = new qq.FineUploader({
            element: document.getElementById(attrs.id),
            template: 'qq-template-gallery', 
            multiple: false,
            allowMultipleItems: false,
            request: {
                endpoint:  base_url+'admin/upload_files',
            },
            deleteFile: {
                enabled: true,
                forceConfirm: true,
                endpoint:  base_url+'admin/upload_files',
            },
            validation: {
                allowedExtensions: extn_arr,
                sizeLimit: 5 * 1024* 1024
            },
            callbacks: {
                onDelete: function(id) {
                    console.log(attrs);
                    $('.qq-upload-list').html('');
                    if(attrs.id == 'global-file-upload-testimonial') {
                        $scope.testimonial.user_img =  "";
                    } else if(attrs.id == 'global-file-upload-latest-article') {
                        $scope.latest_article.article_image =  "";
                    }
                    else if(attrs.id == 'global-file-upload-archive-pdf') {
                        $scope.archive_info.archive_pdf =  "";
                    } else if(attrs.id == 'global-file-upload-s-pdf') {
                        $scope.archive_info.supli_pdf =  "";
                    } else if(attrs.id == ' global-file-upload-eb-member') {
                        $scope.eb_member.eb_member_photo =  "";
                    }
                   
                    $scope.$apply();
                },
                onComplete: function(id, name, responseJSON, maybeXhr) {                        
                    if(attrs.id == 'global-file-upload-testimonial') {
                        $scope.testimonial.user_img =  responseJSON.file_data.upload_data.file_name;
                    } else if(attrs.id == 'global-file-upload-latest-article') {
                        $scope.latest_article.article_image =  responseJSON.file_data.upload_data.file_name;
                    } else if(attrs.id == 'global-file-upload-archive-pdf') {
                        $scope.archive_info.archive_pdf =  responseJSON.file_data.upload_data.file_name;
                    } else if(attrs.id == 'global-file-upload-s-pdf') {
                        $scope.archive_info.supli_pdf =  responseJSON.file_data.upload_data.file_name;
                    }else if(attrs.id == 'global-file-upload-eb-member') {
                        $scope.eb_member.eb_member_photo =  responseJSON.file_data.upload_data.file_name;
                    }
                    $scope.$apply();
                },
                onSubmit: function() {
                     angular.element('#'+attrs.id).closest('.col-sm-9').find('.repopulate-uploaded-file').find('.qq-upload-list').remove();
                     //angular.element('.repopulate-uploaded-file').find('.qq-upload-list').remove();
                }
            }
        });
        $scope.removeFile =  function() {
            console.log(attrs.id);
            console.log($scope);
            angular.element('.repopulate-uploaded-file').find('.qq-upload-list').remove();
            if(attrs.id == 'global-file-upload-testimonial') {
                $scope.testimonial.user_img =  "";
            } else if(attrs.id == 'global-file-upload-latest-article') {
                $scope.latest_article.article_image =  "";
            } else if(attrs.id == 'global-file-upload-archive-pdf') {
                $scope.archive_info.archive_pdf =  "";
            } else if(attrs.id == 'global-file-upload-s-pdf') {                
                $scope.archive_info.supli_pdf =  "";
            } else if(attrs.id == 'global-file-upload-eb-member') {
                $scope.eb_member.eb_member_photo =  "";
            }
            $scope.$apply();
        }
  }

  }
});

app.directive("uploadsFilesToServer", function($http,$timeout) {
return {
    restrict : "A",
        link: function($scope, element, attrs) {
            if(attrs.id == 'avens-to-server') {
                var ser_url = base_url+'admin/upload_files?save_to_db=true';
            } else if(attrs.id == 'fulltext-server') {
                var ser_url = base_url+'admin/upload_files_to_server';
            }
            var uploader = new qq.FineUploader({
                element: document.getElementById(attrs.id),
                template: 'custom-qq-template-gallery', 
                multiple: false,
                debug: true,
                allowMultipleItems: false,
                request: {
                    endpoint:  ser_url,
                },
                deleteFile: {
                    enabled: true,
                    forceConfirm: true,
                    endpoint:  ser_url,
                },
                validation: {
                    allowedExtensions: ['png','jpeg','jpg','gif','pdf'],
                    sizeLimit: 5 * 1024* 1024
                },
                callbacks: {
                    onDelete: function(id) {
                        
                    },
                    onComplete: function(id, name, responseJSON, maybeXhr) {
                        $scope.spinner= true;
                        $http({
                            url: base_url+'admin/getUploadedFiles',
                            method: "POST"
                        })
                        .then(function(response) {
                            $scope.gridOptions1.data = response.data;
                             $timeout(function() {
                                $scope.spinner= false;
                             }, 500);        
                        });
                        
                    },
                    onSubmit: function() {

                    }
                }
            });
        }
    }
});

app.directive('myGrid', myGrid);
function myGrid($timeout) {
    //$timeout(function(){
     return {          
          templateUrl:base_url+'admin1/angular_pages/GridTemplate.html',
          restrict: 'E',
          scope: {
              options : '=',
          },
          bindToController: true,
          link: function(scope, element, attrs) {                
                console.log(attrs);            
                console.log(scope.options.columnDefs);
                scope.gridOptions = {
                  data: scope.options.data, 
                  columnDefs: scope.options.columnDefs, 
                };
          }
      };
    //},3000);
}