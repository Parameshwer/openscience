app.factory("factory", ['$http', function($http) {
  var serviceBase = 'factory/'
    var obj = {};
    obj.get_main_category = function(main_cat_id){
        return $http.get(base_url+"admin/get_main_category?id="+main_cat_id+"");
    }
    obj.get_latest_update = function(update_id){
        return $http.get(base_url+"admin/get_latest_update?id="+update_id+"");
    }
    obj.get_journal = function(main_cat_id){
        return $http.get(base_url+"admin/get_journal?id="+main_cat_id+"");
    }
    obj.get_journalPage = function(PageId){
        return $http.get(base_url+"admin/get_journalPage?id="+PageId+"");
    }
    obj.insertCategory = function (main_category) {
        return $http.get(base_url+"admin/insert_main_category?name="+main_category.cateogry_name+"");       
        
    };
    obj.get_journals = function(journal_type) {        
        return $http.get(base_url+"admin/get_journals?name="+journal_type+"");
    }
    obj.get_journalArchive = function(archive_id) {        
        return $http.get(base_url+"admin/get_journal_archive?id="+archive_id+"");
    }
    obj.get_LatestArticle = function(article_id) {        
        return $http.get(base_url+"admin/get_latest_Article?id="+article_id+"");
    }
    obj.get_Testimonials = function(article_id) {        
        return $http.get(base_url+"admin/get_Testimonial?id="+article_id+"");
    }
    obj.get_Suplitype = function(article_id) {        
        return $http.get(base_url+"admin/get_Suplitype?id="+article_id+"");
    }
    obj.get_FulltextArticle = function(a_id) {        
        return $http.get(base_url+"admin/get_FulltextArticle?id="+a_id+"");
    }
    obj.get_Ebmember = function(eb_id) {        
        return $http.get(base_url+"admin/get_Ebmember?id="+eb_id+"");
    }
    obj.get_New_Ebmember = function(eb_id) {        
        return $http.get(base_url+"admin/get_new_eb_member?id="+eb_id+"");
    }
    obj.updateCategory = function (id,main_category,scope) {        
        //return $http.get(base_url+"admin/insert_main_category?name="+main_category.category_name+"&id="+main_category.category_id+"");
        var params = [];
        params.push("category_id="+id+"");
        params.push("category_name="+main_category.category_name+"");
        $http({
            url: base_url+"admin/insert_main_category",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify({"category_id":id,"category_name":main_category.category_name})          
        })
        .then(function(response) {            
            if(response.status) {                
                scope.server_msg = response.data.message;
                setTimeout(function() {
                    scope.server_msg = '';
                    window.location = base_url+'admin#/MainCategories'                            
                },2000);                
            }
        });
    };

    obj.updateLatestUpdate = function (id,latest_update,scope) {                    
        $http({
            url: base_url+"admin/insert_latest_update",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify({"id":id,"latest_update_description":latest_update.latest_update_description})          
        })
        .then(function(response) {            
            if(response.status) {                
                scope.server_msg = response.data.message;
                setTimeout(function() {
                    scope.server_msg = '';
                    window.location = base_url+'admin#/HomeLatestUpdates'                            
                },2000);                
            }
        });
    };

    obj.updateJournal = function (id,main_journal,scope) {        
        //return $http.get(base_url+"admin/insert_main_category?name="+main_category.category_name+"&id="+main_category.category_id+"");        
        /*if(!id) {
            main_journal.main_category_id = 0;
        }*/
        //main_journal.journal_url_slug = main_journal.journal_name.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');        
        $http({
            url: base_url+"admin/insert_journal",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(main_journal)          
        })
        .then(function(response) {            
            if(response.status) {
                scope.server_msg = response.data.message;
                setTimeout(function(){
                    window.location = base_url+'admin#/Journals';
                },2000);
            }
        });
    };
    obj.updateJournalPage = function (id,journal_page,scope) {                
        $http({
            url: base_url+"admin/update_journal_page",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(journal_page)          
        })
        .then(function(response) {            
            if(response.status) {
                scope.server_msg = response.data.message;
                setTimeout(function(){
                    window.location = base_url+'admin#/JournalPosts';
                },2000);
            }
        });
    };
    obj.updateEbMember = function (id,eb_member,scope) {                
        $http({
            url: base_url+"admin/update_eb_member",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(eb_member)          
        })
        .then(function(response) {            
            if(response.status) {
                scope.server_msg = response.data.message;
                setTimeout(function(){
                    window.location = base_url+'admin#/NewEbMembers'                
                },2000);
            }
        });
    };
    obj.updateJournalArchive = function (id,archive_info,scope) {        
        //return $http.get(base_url+"admin/insert_main_category?name="+main_category.category_name+"&id="+main_category.category_id+"");
        /*if(!id) {
            archive_info.main_category_id = 0;
        }*/        
        $.each(scope.journal_info,function(i,v){
            if(v.id == archive_info.journal_id) {                           
                archive_info.journal_slug = v.journal_name.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');                            
            }
        });
        $http({
            url: base_url+"admin/update_archive",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(archive_info)          
        })
        .then(function(response) {            
            if(response.status) {
                scope.server_msg = response.data.message;
                setTimeout(function(){
                    window.location = base_url+'admin#/archives'                
                },2000);
            }
        });
    };
    obj.updateLatestArticle = function (id,article_info,scope) {                
        $http({
            url: base_url+"admin/update_latest_article",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(article_info)          
        })
        .then(function(response) {            
            if(response.status) {
                scope.server_msg = response.data.message;
                setTimeout(function(){
                    window.location = base_url+'admin#/LatestArticles';
                },2000);
            }
        });
    };
    obj.updateTestimonial = function (id,testimonials,scope) {                    
        $http({
            url: base_url+"admin/updateTestimonial",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(testimonials)          
        })
        .then(function(response) {            
            if(response.status) {
                scope.server_msg = response.data.message;
                setTimeout(function(){
                    window.location = base_url+'admin#/Testimonials';
                },2000);
            }
        });
    };
 obj.updateJournalVolume = function (id,suplitypes,scope) {                    
        $http({
            url: base_url+"admin/update_journal_volume",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(suplitypes)          
        })
        .then(function(response) {            
            if(response.status) {
                window.location = base_url+'admin#/addSupliTypes'                
            }
        });
    };
 obj.updateFulltextArticle = function (id,fulltextarticle,scope) {                    
        $http({
            url: base_url+"admin/update_fulltext_article",
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            data : JSON.stringify(fulltextarticle)          
        })
        .then(function(response) {            
            if(response.status) {
                scope.server_msg = response.data.message;
                setTimeout(function(){
                    window.location = base_url+'admin#/FulltextArticles';                    
                },2000);
            }
        });
    };
    obj.saveUploadedImage = function(id, file) {
        var data = new FormData(jQuery('#journal_form')[0]);             
        jQuery.ajax({
            type:"POST",
            url: base_url+'admin/save_uploaded_file',
            data: data,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            success:function(temp) {
            console.log(temp);  
            if(temp.file_type == 'journal_banner_img') {
               $('.uploaded-banner-img').remove();
               $('#journal_banner_img').closest('.banner-img-box').append('<div class="uploaded-banner-img"><input type="hidden" name="uploaded_file" value="'+temp[0].upload_data.file_name+'"><p><img width="200px" height="200px" src="'+temp.uploaded_path+'" alt="'+temp[0].upload_data.file_name+'" /><span class="remove-file">Remove File</span></p></div>');
            } else {
               $('.uploaded-sidebar-img').remove();
               $('#journal_sidebar_img').closest('.sidebar-img-box').append('<div class="uploaded-banner-img"><input type="hidden" name="uploaded_file" value="'+temp[0].upload_data.file_name+'"><p><img width="200px" height="200px" src="'+temp.uploaded_path+'" alt="'+temp[1].upload_data.file_name+'" /><span class="remove-file">Remove File</span></p></div>');
            }
            }
        });  
    }

    return obj;   
}]);