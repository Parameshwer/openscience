app.directive("globalFileUpload", function() {    
return {
        restrict : "A",        
        link: function($scope, element, attrs) {                        
            var extn_arr = $scope.$eval(attrs.fileExts);            

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
                    if(attrs.id == 'upload-journal-image') {
                        $scope.journalCtrl.entity.journal_image = "";                        
                    }

                    $scope.$apply();
                },
                onComplete: function(id, name, responseJSON, maybeXhr) {  
                    if(responseJSON.success) {
                        if(attrs.id == 'upload-journal-image') {
                            $scope.journalCtrl.entity.journal_image = responseJSON.upload_data.file_name;
                            //$scope.journalCtrl.entity.full_path = responseJSON.upload_data.full_path;
                        }
                        $scope.$apply();
                    }
                    
                    angular.element('.repopulate-uploaded-file').remove();                  
                },
                onSubmit: function() {                    
                     angular.element('.repopulate-uploaded-file').remove();                     
                }
            }
        });        
        $scope.removeFile = function() {
            if(attrs.id == 'upload-journal-image') {
                $scope.journalCtrl.entity.journal_image = "";                        
            }            
        }
  }

  }
});