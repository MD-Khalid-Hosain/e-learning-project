$(document).ready(function(){

    /*---------------------------------
    right side sorting start
    -----------------------------------*/

     $("#searchSort").on('change', function(){
        this.form.submit();
    });

    $("#sort").on('change', function () {
        var sort = $(this).val();
        var slug = $("#slug").val();
        var filter_id = [];
        $('.filterProduct').each(function(){
            if($(this).is(":checked")){
                filter_id.push($(this).val());
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: slug,
            method: "GET",
            data: { sort: sort, slug: slug, filter_id:filter_id},
            success: function (data) {
                $('.filter_prodcuts').html(data);
            }
        });
    });

    $(".filterProduct").on('click',function(){

        var sort = $("#sort option:selected").val();
        var slug = $("#slug").val();

        var filter_id = [];
        $('.filterProduct').each(function(){
            if($(this).is(":checked")){
                filter_id.push($(this).val());
            }
        });

        // vairiant_id = filter_id.toString();
        // filter_id = vairiant_id;

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $.ajax({
            url: slug,
            method: "GET",
            data: { sort: sort, slug: slug, filter_id: filter_id},
            success: function (data) {
                $('.filter_prodcuts').html(data);
            }
        });
    });


/*---------------------------------
right side sorting end
-----------------------------------*/
/*---------------------------------
    Cart coupon apply start
-----------------------------------*/
  $('#applyCoupon').click( function(){
        var coupon_name = $('#coupon_name').val();
        var couponLink = $('#couponLink').val();
        var link_to_go = couponLink+"/"+coupon_name;
        window.location.href = link_to_go;
    });

/*---------------------------------
    Cart coupon apply end
-----------------------------------*/

/*---------------------------------
    show password start
-----------------------------------*/
    $('#show_password').click(function(){
        var show = $('#show_password').text();
        if(show== "Show"){
            $('#password').get(0).type = 'text';
            show = $('#show_password').text('Hide');
        }else{
            $('#password').get(0).type = 'password';
            show = $('#show_password').text('Show');
        }
    });
/*---------------------------------
    show password end
-----------------------------------*/


/*---------------------------------
    show password start
-----------------------------------*/
    $('#confirm_password').click(function(){
        var show = $('#confirm_password').text();
        if(show== "Show"){
            $('#passwordConfirm').get(0).type = 'text';
            show = $('#confirm_password').text('Hide');
        }else{
            $('#passwordConfirm').get(0).type = 'password';
            show = $('#confirm_password').text('Show');
        }
    });
/*---------------------------------
    show password end
-----------------------------------*/
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
        var checkCurrentPwd = $("#checkCurrentPwd").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: checkCurrentPwd,
            data: { current_pwd: current_pwd },
            success: function (resp) {
                if (resp == "false") {
                    $("#check_current_pwd").html("<font color= red>Password is Incorrect</font>")
                } else if (resp == "true") {
                    $("#check_current_pwd").html("<font color= green>Password is Correct</font>")
                }
            }, error: function () {
                alert("error");
            }
        });
    });

    //new password and confirm password is matching or not
    $('#confirm_pwd').keyup(function () {
        var new_pwd = $('#new_pwd').val();
        var confirm_pwd = $('#confirm_pwd').val();

        if (new_pwd != confirm_pwd) {
            $("#showError").html("<font color= red>Password is not match</font>");
        } else {
            $("#showError").html("<font color= green>Password matched </font>");
        }

    });
/*---------------------------------
    algolia serarch start
-----------------------------------*/



    var client = algoliasearch('FC88WWJXEF', '56c93e10786ef27138b6cd344c7a79b1');
    var index = client.initIndex('product_name');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'product_name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                <img src="${window.location.origin}/public/backend/uploads/product_main_image/${suggestion.main_image}" alt="img" class="algolia-thumb">
                                ${suggestion._highlightResult.product_name.value}
                            </span>

                        </div>
                        <div class="algolia-details">
                            <span>৳${(suggestion.price)}</span>
                        </div>
                    `;

                    return markup;
                },
                empty: function (result) {
                    return 'Sorry, we did not find any results for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            window.location.href = window.location.origin + '/product/' + suggestion.slug;
            // window.location.href = url('product/'+suggestion.slug);
            enterPressed = true;
        });
/*---------------------------------
    algolia serarch start
-----------------------------------*/

/*---------------------------------
    algolia serarch start 2
-----------------------------------*/


    var client = algoliasearch('FC88WWJXEF', '56c93e10786ef27138b6cd344c7a79b1');
    var index = client.initIndex('product_name');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('.aa-search-input2',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'product_name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                <img src="${window.location.origin}/public/backend/uploads/product_main_image/${suggestion.main_image}" alt="img" class="algolia-thumb">
                                ${suggestion._highlightResult.product_name.value}
                            </span>

                        </div>
                        <div class="algolia-details">
                            <span>৳${(suggestion.price)}</span>
                        </div>
                    `;

                    return markup;
                },
                empty: function (result) {
                    return 'Sorry, we did not find any results for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            window.location.href = window.location.origin +'/product/' + suggestion.slug;
            // window.location.href = url('product/'+suggestion.slug);
            enterPressed = true;
        });
/*---------------------------------
    algolia serarch start 2
-----------------------------------*/

/*---------------------------------
Delete Cart Item start
-----------------------------------*/
    $('.itemDelete').click(function () {
        var cartid = $(this).data('cartid');
        var cartRoute = $('#cartRoute').val();
        alert(cartid);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            data: {"cartid": cartid },
            type: 'post',
            url:cartRoute,
            success: function () {

            }, error: function () {
                alert("error");
            }
        });
    });
/*---------------------------------
Delete Cart Item end
-----------------------------------*/


//    $('.pcBuildDelete').click(function () {

//         var pcbuildid = $(this).attr("pcbuildid");
//         var pcbuildurl = $('#pcbuildurl').val();
//         // alert(pcbuildurl);
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             data: {"pcbuildid": pcbuildid },
//             type: 'post',
//             url:pcbuildurl,
//             success: function(resp) {
//                 if(resp.status==false){
//                     alert('resp.message');
//                 }
//                 $("#pcbuildTable").html(resp.view);
//             }, error: function () {
//                 alert("error");
//             }
//         });
//     });




});
