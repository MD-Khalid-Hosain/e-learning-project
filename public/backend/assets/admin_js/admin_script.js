$(document).ready(function () {

    //current password is correct or not start
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        var checkCurrentPwd = $("#checkCurrentPwd").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'post',
            url:checkCurrentPwd,
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp == "false"){
                    $("#check_current_pwd").html("<font color= red>Password is Incorrect</font>")
                } else if (resp == "true"){
                    $("#check_current_pwd").html("<font color= green>Password is Correct</font>")
                }
            },error:function(){
                alert("error");
            }
        });
        //current password is correct or not end

        //new password and confirm password is matching or not
        $('#confirm_pwd').keyup(function (){
            var new_pwd = $('#new_pwd').val();
            var confirm_pwd = $('#confirm_pwd').val();

            if (new_pwd != confirm_pwd){
                $("#showError").html("<font color= red>Password is not match</font>");
            }else{
                $("#showError").html("<font color= green>Password matched </font>");
            }

        });
    });

     $('#admin_confirm_pwd').keyup(function (){
            var new_pwd = $('#admin_new_pwd').val();
            var confirm_pwd = $('#admin_confirm_pwd').val();

            if (new_pwd != confirm_pwd){
                $("#adminShowError").html("<font color= red>Password is not match</font>");
            }else{
                $("#adminShowError").html("<font color= green>Password matched </font>");
            }

        });


    //Admin status active or inactive
    $(".adminStatus").click(function(){
        var status = $(this).text();
        var admin_id = $(this).attr("admin_id");
        var updateAdminStatus = $('#updateAdminStatus').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateAdminStatus,
            data:{status:status,admin_id:admin_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#admin-"+admin_id).html("<a class='adminStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#admin-"+admin_id).html("<a class='adminStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Admin status active or inactive end
    //Section status active or inactive
    $(".updateSectionStatus").click(function(){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        var updateSectionStatus = $('#updateSectionStatus').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateSectionStatus,
            data:{status:status,section_id:section_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Section status active or inactive end
    //Barand status active or inactive
    $(".updateBrandStatus").click(function(){
        var status = $(this).text();
        var brand_id = $(this).attr("brand_id");
        var updateBrandStatus = $('#updateBrandStatus').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateBrandStatus,
            data:{status:status,brand_id:brand_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#brand-"+brand_id).html("<a class='updateBrandStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#brand-"+brand_id).html("<a class='updateBrandStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Brand status active or inactive end
    //Category status active or inactive
    $(".updateCategoryStatus").click(function(){
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        var updateCategoryStatus = $('#updateCategoryStatus').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateCategoryStatus,
            data:{status:status,category_id:category_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Category status active or inactive end
    //Product status active or inactive
    $(".updateProductStatus").click(function(){
        var status = $(this).text();
        var product_id = $(this).attr("product_id");
        var updateProductStatus = $('#updateProductStatus').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateProductStatus,
            data:{status:status,product_id:product_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Product status active or inactive end

    //Each Product Specification status active or inactive
    $(".updateHomeImageStatus").click(function(){
        var status = $(this).text();
        var image_id = $(this).attr("image_id");
        var updateHomeImageStatus = $("#updateHomeImageStatus").val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateHomeImageStatus,
            data:{status:status,image_id:image_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#homeImage-"+image_id).html("<a class='updateHomeImageStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#homeImage-"+image_id).html("<a class='updateHomeImageStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Product Specification status active or inactive end


    //Each Product Short Description status active or inactive
    $(".productShortDescStatus").click(function(){
        var status = $(this).text();
        var product_short_des_id = $(this).attr("product_short_des_id");


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:'/admin/update-productShortDesc-status',
            data:{status:status,product_short_des_id:product_short_des_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#shortDesc-"+product_short_des_id).html("<a class='productShortDescStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#shortDesc-"+product_short_des_id).html("<a class='productShortDescStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    ////Each Product Short Description status active or inactive end
    //Each Product Feature status active or inactive
    $(".productFeatureStatus").click(function(){
        var status = $(this).text();
        var product_feature_id = $(this).attr("product_feature_id");


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:'/admin/update-productFeature-status',
            data:{status:status,product_feature_id:product_feature_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#feature-"+product_feature_id).html("<a class='productFeatureStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#feature-"+product_feature_id).html("<a class='productFeatureStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Product Feature status active or inactive end
       //Contact status active or inactive
    $(".updateContactStatus").click(function(){
        var status = $(this).text();
        var contact_id = $(this).attr("contact_id");
        var updateContactStatus = $('#updateContactStatus').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateContactStatus,
            data:{status:status,contact_id:contact_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#contact-"+contact_id).html("<a class='updateContactStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#contact-"+contact_id).html("<a class='updateContactStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Contact status active or inactive end
       //Scroll status active or inactive
    $(".updateScrollStatus").click(function(){
        var status = $(this).text();
        var scroll_id = $(this).attr("scroll_id");
        var updateScrollStatus = $('#updateScrollStatus').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateScrollStatus,
            data:{status:status,scroll_id:scroll_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#scroll-"+scroll_id).html("<a class='updateScrollStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#scroll-"+scroll_id).html("<a class='updateScrollStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Scroll status active or inactive end
       //Offer status active or inactive
    $(".updateOfferStatus").click(function(){
        var status = $(this).text();
        var offer_id = $(this).attr("offer_id");
        var updateOfferStatus = $('#updateOfferStatus').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateOfferStatus,
            data:{status:status,offer_id:offer_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#offer-"+offer_id).html("<a class='updateOfferStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#offer-"+offer_id).html("<a class='updateOfferStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Offer status active or inactive end
       //Review status active or inactive
$(".updateReviewStatus").click(function(){
        var status = $(this).text();
        var review_id = $(this).attr("review_id");
        var updateReviewStatus = $('#updateReviewStatus').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:updateReviewStatus,
            data:{status:status,review_id:review_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#review-"+review_id).html("<a class='updateReviewStatus' href='javascript:void(0)' style='color:red'>Disapproved</a>");
                }else if(resp['status']==1){
                      $("#review-"+review_id).html("<a class='updateReviewStatus' href='javascript:void(0)'  style='color:green'>Approved</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Review status active or inactive end

    //append categories level
    $("#section_id").change(function (){
        var section_id = $(this).val();
        var appendCategories = $('#appendCategories').val();
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'post',
            url:appendCategories,
            data:{section_id:section_id},
            success:function(resp){
                $("#appendCategoriesLevel").html(resp);
            },error:function(){
                alert("Error");
            }

        });
    });
    //append categories level end

    //confirm deletion of record

    /*$(".confirmDelete").click(function(){
        var name = $(this).attr("name");
        if(confirm("Are you sure to delete this "+name+"?")){
            return true;
        }
        return false;
    });*/
    //Role confirm deletion of record with sweetAlert start
    $(".confirmDeleteOffer").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    //Role confirm deletion of record with sweetAlert end
    //Role confirm deletion of record with sweetAlert start
    $(".confirmDeleteComponent").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    //Role confirm deletion of record with sweetAlert end
    //Role confirm deletion of record with sweetAlert start
    $(".confirmDeleteReview").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    $(".confirmDeleteQuestion").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    //Role confirm deletion of record with sweetAlert end
    //Role confirm deletion of record with sweetAlert start
    $(".RoleconfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    //Role confirm deletion of record with sweetAlert end
    //Brand confirm deletion of record with sweetAlert start
    $(".confirmDeleteBrand").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    //Brand confirm deletion of record with sweetAlert end

    //Section confirm deletion of record with sweetAlert start
    $(".confirmDeleteSection").click(function(){
        var recordid = $(this).attr("recordid");


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    //Section confirm deletion of record with sweetAlert end
    //Category confirm deletion of record with sweetAlert start
    $(".confirmDeleteCategory").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });

    });
    //Category confirm deletion of record with sweetAlert end
    //Admin confirm deletion of record with sweetAlert start
    $(".confirmDeleteAdmin").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //confirm deletion of record with sweetAlert end

    //Admin Delete category Image confirm deletion of record with sweetAlert start
    $(".confirmDeleteCategoryImage").click(function(){
        // var recordid = $(this).attr("recordid");
        var categoryImageDelete = $('#categoryImageDelete').val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= categoryImageDelete;
            }
        });


    });
    //Delete category Image confirm deletion of record with sweetAlert end

    //contact confirm deletion of record with sweetAlert start
    $(".contactConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //contact confirm deletion of record with sweetAlert end
    //scroll confirm deletion of record with sweetAlert start
    $(".scrollConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //scroll confirm deletion of record with sweetAlert end
    //Product confirm deletion of record with sweetAlert start
    $(".productConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Product confirm deletion of record with sweetAlert end
    //Filter Item confirm deletion of record with sweetAlert start
    $(".filterItemConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Filter Item confirm deletion of record with sweetAlert end

    //Specification confirm deletion of record with sweetAlert start
    $(".specificationConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Specification confirm deletion of record with sweetAlert end
    //Item type confirm deletion of record with sweetAlert start
    $(".itemTypeConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    ////Item type confirm deletion of record with sweetAlert end
    //Item Parts confirm deletion of record with sweetAlert start
    $(".itemPartsconfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Item Parts confirm deletion of record with sweetAlert end
    //Product features confirm deletion of record with sweetAlert start
    $(".productFeatureconfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Product features confirm deletion of record with sweetAlert end
    //Item Parts confirm deletion of record with sweetAlert end
    //header confirm deletion of record with sweetAlert start
    $(".headerconfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Header confirm deletion of record with sweetAlert end
    //slider image confirm deletion of record with sweetAlert start
    $(".sliderConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Slider Image confirm deletion of record with sweetAlert end
    //Right Side image confirm deletion of record with sweetAlert start
    $(".rightSideConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Right Side Image confirm deletion of record with sweetAlert end
    //Coupon confirm deletion of record with sweetAlert start
    $(".couponConfirmDelete").click(function(){
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= recordid;
            }
        });


    });
    //Coupon confirm deletion of record with sweetAlert end


    //add remove field product sort description

   var maxField1 = 100; //Input fields increment limitation
        var addButton1 = $('.add_button1'); //Add button selector
        var wrapper1 = $('.shortDescriptionAddRemove'); //Input field wrapper
        var fieldHTML1 = '<div id="remove_field1"><div class="row clearfix"> <div class="col-md-4"> <input type="text" name="short_desc_title[]" placeholder="Enter title" class="form-control"/> </div><div class="col-md-4"><input type="text" name="product_short_desc[]" placeholder="Enter Short Description" class="form-control"/></div><div class="col-md-4"><button type="button" name="add"  class="btn btn-danger remove_button1">Remove</button> </div> </div> </div>'; //New input field html
        var i = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton1).click(function(){
            //Check maximum number of input fields
            if(i < maxField1){
                i++; //Increment field counter
                $(wrapper1).append(fieldHTML1); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper1).on('click', '.remove_button1', function(e){
            e.preventDefault();
             $(this).parents('#remove_field1').remove(); //Remove field html
            i--; //Decrement field counter
        });
    //add remove field product specification

   var maxField3 = 100; //Input fields increment limitation
        var addButton3 = $('.add_button3'); //Add button selector
        var wrapper3 = $('.specificationAddRemove'); //Input field wrapper
        var fieldHTML3 = '<div id="remove_field3"><div class="row clearfix"><div class="col-md-4"><input type="text" name="specification_title[]" placeholder="Enter title" class="form-control" /></div> <div class="col-md-4"> <input type="text" name="product_specification[]" placeholder="Enter product specification" class="form-control"/> </div> <div class="col-md-4"> <button type="button" name="add"  class="btn btn-danger remove_button3">Remove</button></div></div></div>'; //New input field html
        var j = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton3).click(function(){
            //Check maximum number of input fields
            if(j < maxField3){
                j++; //Increment field counter
                $(wrapper3).append(fieldHTML3); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper3).on('click', '.remove_button3', function(e){
            e.preventDefault();
             $(this).parents('#remove_field3').remove(); //Remove field html
            j--; //Decrement field counter
        });



    //add remove field product Fetures

    var maxField2 = 5; //Input fields increment limitation
        var addButton2 = $('.add_button2'); //Add button selector
        var wrapper2 = $('.shortSpecificationAddRemove'); //Input field wrapper
        var fieldHTML2 = '<div id="remove_field2"><div class="row clearfix"><div class="col-md-8"> <input type="text" name="fetures[]"  class="form-control"/></div><div class="col-md-4"> <button type="button" name="add" class="btn btn-danger remove_button2">Remove</button></div> </div> </div>'; //New input field html
        var k = 1; //Initial field counter is 1
      //Once add button is clicked
        $(addButton2).click(function(){
            //Check maximum number of input fields
            if(k < maxField2){
                k++; //Increment field counter
                $(wrapper2).append(fieldHTML2); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper2).on('click', '.remove_button2', function(){

             $(this).parents('#remove_field2').remove(); //Remove field html
            k--; //Decrement field counter
        });




    //add remove field product Filtering

    var maxField4 = 100; //Input fields increment limitation
        var addButton4 = $('.add_button4'); //Add button selector
        var wrapper4 = $('.filteringAddRemove'); //Input field wrapper
        var fieldHTML4 = '<div id="remove_field4"><div class="row clearfix"> <div class="col-md-4"> <input type="text" name="filtering_title[]" placeholder="Enter title" class="form-control" /> </div><div class="col-md-4"><input type="text" name="product_filtering[]" placeholder="Enter Product Filtering" class="form-control"/></div><div class="col-md-4"><button type="button" name="add"  class="btn btn-danger remove_button4">Remove</button> </div> </div> </div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton4).click(function(){
            //Check maximum number of input fields
            if(x < maxField4){
                x++; //Increment field counter
                $(wrapper4).append(fieldHTML4); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper4).on('click', '.remove_button4', function(e){
            e.preventDefault();
             $(this).parents('#remove_field4').remove(); //Remove field html
            x--; //Decrement field counter
        });

    //add remove field product Specification Header Start

    var maxFieldHeader = 100; //Input fields increment limitation
    var addButtonHeader = $('.add_Header'); //Add button selector
    var wrapperHeader = $('.specificationHeader'); //Input field wrapper
    var fieldHTMLHeader = '<div id="removeHeader"><div class="row clearfix"><div class="col-md-8"> <input type="text" name="header[]" class="form-control"/></div><div class="col-md-4"> <button type="button" name="add" class="btn btn-danger remove_header">Remove</button></div> </div> </div>'; //New input field html
    var k = 1; //Initial field counter is 1
  //Once add button is clicked
    $(addButtonHeader).click(function(){
        //Check maximum number of input fields
        if(k < maxFieldHeader){
            k++; //Increment field counter
            $(wrapperHeader).append(fieldHTMLHeader); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapperHeader).on('click', '.remove_header', function(){

         $(this).parents('#removeHeader').remove(); //Remove field html
        k--; //Decrement field counter
    });

    //add remove field product Specification Header End

    //add remove field product specification title and description

    var maxFieldTitle = 100; //Input fields increment limitation
    var addButtontitle = $('.add_title_desc'); //Add button selector
    var wrapperTitle = $('.titleRemove'); //Input field wrapper
    var fieldHTMLTitle = '<div id="titleRemove"><div class="row clearfix"><div class="col-md-3"><input type="text" name="title[]" class="form-control" /></div><div class="col-md-5"> <textarea   name="description[]"  class="form-control summernote" rows="3"></textarea></div><div class="col-md-3"><button type="button" name="add" class="btn btn-danger titleRemove">Remove</button></div></div></div>'; //New input field html
    var k = 1; //Initial field counter is 1
  //Once add button is clicked
    $(addButtontitle).click(function(){
        //Check maximum number of input fields
        if(k < maxFieldTitle){
            k++; //Increment field counter
            $(wrapperTitle).append(fieldHTMLTitle); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapperTitle).on('click', '.titleRemove', function(){

         $(this).parents('#titleRemove').remove(); //Remove field html
        k--; //Decrement field counter
    });

//add remove field product Filtering

});
