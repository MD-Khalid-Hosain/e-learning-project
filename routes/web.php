<?php

use App\Product;
use App\Category;
use App\Http\Controllers\Dashboard\HomeImagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Frontend\FrontendController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['namespace' => 'Dashboard'], function () {
Route::match(['get', 'post'], '/admin/login','AdminController@login');

Route::match(['get', 'post'], '/admin/forgot/password', 'AdminController@forgetPassword')->name('admin-forgot-password');
Route::group(['middleware'=>['admin']], function(){
        /*
        |--------------------------------------------------------------------------
        | Dashboard and Admin Controller Route Starts
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');


        Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
        Route::get('admin/settings', 'AdminController@settings')->name('admin-settings');
        Route::post('/check-current-pwd', 'AdminController@checkCurrentPassword')->name('check-current-pwd');
        Route::post('/update-current-pwd', 'AdminController@updateCurrentPwd')->name('update-current-pwd');
        Route::match(['get', 'post'],'/admin/update-details', 'AdminController@updateAdminDetails');
        Route::post('/update-admin-status', 'AdminController@updateAdmintStatus')->name('update-admin-status');
        Route::post('/user/create', 'AdminController@createUser')->name('management.createUser');

        /*
        |--------------------------------------------------------------------------
        | Dashboard and Admin Controller Route End
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | Role Controller Route Starts
        |--------------------------------------------------------------------------
        */

            Route::get('/role/management', 'RoleController@index')->name('management.index');
            Route::post('/role/management', 'RoleController@addRole')->name('management.index');
            Route::get('/admin/delete-role/{id}', 'RoleController@deleteRole')->name('role.delete');
            Route::get('/role/user', 'RoleController@userDetails')->name('management.user');
            Route::post('/role/assign', 'RoleController@assignRole')->name('management.assig.role');
            Route::get('/role/edit/{id}', 'RoleController@editRole')->name('management.edit');
            Route::post('/role/change', 'RoleController@changePermission')->name('management.changePermission');
            Route::get('/delete-user/{id}', 'RoleController@deleteUser')->name('management.deleteUser');

        /*
        |--------------------------------------------------------------------------
        | Role Controller Route End
        |--------------------------------------------------------------------------
        */

        Route::prefix('/admin')->group(function(){
            Route::get('section','SectionController@sections');
            Route::match(['get', 'post'], '/add-edit-section/{id?}', 'SectionController@addEditSection');
            Route::post('/update-section-status','SectionController@updateSectionStatus')->name('update-section-status');
            Route::get('delete-section/{id}', 'SectionController@deleteSection')->name('delete.section');
        /*
        |--------------------------------------------------------------------------
        | Category Controller Route Start
        |--------------------------------------------------------------------------
        */
            Route::get('categories', 'CategoryController@categories');
            Route::post('/update-category-status', 'CategoryController@updateCategoryStatus')->name('update-category-status');
            Route::get('/add-category-form', 'CategoryController@addCategoryForm');
            Route::post('/add-category', 'CategoryController@addCategory');
            Route::get('/edit-category-form/{id}', 'CategoryController@editCategory');
            Route::post('/update-category', 'CategoryController@updateCategory');
            Route::post('append-categories-level', 'CategoryController@appendCategoryLevel')->name('append-categories-level');
            Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage')->name('delete-category-image');
            Route::get('delete-category/{id}', 'CategoryController@deleteCategory')->name('delete-category');


        /*
        |--------------------------------------------------------------------------
        | Category Controller Route End
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | Brand Controller Route Start
        |--------------------------------------------------------------------------
        */
            Route::get('brands', 'BrandController@brands');
            Route::get('/add-brand-form', 'BrandController@addBrandForm');
            Route::post('/create-brand', 'BrandController@createBrand');
            Route::get('/edit-brand/{id}', 'BrandController@editBrand');
            Route::post('/update-brand', 'BrandController@updateBrand');
            Route::post('/update-brand-status', 'BrandController@updateBrandStatus')->name('update-brand-status');
            Route::get('delete-brand/{id}', 'BrandController@deleteBrand')->name('delete.brand');

        /*
        |--------------------------------------------------------------------------
        | Brand Controller Route End
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Product Controller Route Start
        |--------------------------------------------------------------------------
        */
            Route::get('products','ProductController@products');
            Route::post('/update-product-status', 'ProductController@updateProductStatus')->name('update-product-status');
            Route::get('delete-product/{id}', 'ProductController@deleteProduct');
            Route::get('/add-product', 'ProductController@addProduct');
            Route::post('/post-product', 'ProductController@addProductPost');
            Route::get('/product-details/{id}', 'ProductController@ProductDetails');
            Route::get('/edit-product/{id}', 'ProductController@ProductEdit');
            Route::post('/update-product', 'ProductController@ProductUpdate');
            Route::get('delete-product/{id}', 'ProductController@deleteProduct')->name('delete.product');


            Route::match(['get', 'post'], '/add-productAllSepecification/{id}', 'ProductController@addProductAllSpecification');
            Route::post('/edit-specificationHeader/{id}', 'ProductController@editSpecificationHeader');
            Route::post('/edit-specification/{id}', 'ProductController@editSpecification');
            Route::post('/edit-fetures/{id}', 'ProductController@editFeture');
            Route::post('/edit-filter/{id}', 'ProductController@editFilter');

            Route::get('delete-productSpecification/{id}', 'ProductController@deleteProductSpecification')->name('specification.delete');
            Route::get('delete-productFeature/{id}', 'ProductController@deleteProductFeature')->name('feature.delete');
            Route::get('delete-productFilter/{id}', 'ProductController@deleteProductFilterItem')->name('productFilterItem.delete');
            Route::get('delete-specificationeader/{id}', 'ProductController@deleteHeader')->name('header.delete');
        /*
        |--------------------------------------------------------------------------
        | Product Controller Route End
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | ProductTypeController  Route Start
        |--------------------------------------------------------------------------
        */

        Route::get('/product-type', 'ProductTypeController@productType');
        Route::post('/add-productItem-type', 'ProductTypeController@addProductType');
        Route::get('/edit-itemType/{id}','ProductTypeController@editType');
        Route::post('/update-itemType', 'ProductTypeController@itemTypeUpdate');
        Route::get('delete-itemType/{id}', 'ProductTypeController@deleteitemTypeDelete')->name('itemType.delete');
        /*
        |--------------------------------------------------------------------------
        | ProductTypeController  Route End
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Item Parts Controller  Route Start
        |--------------------------------------------------------------------------
        */

            Route::get('/product-type-parts', 'ItemPartsController@productTypeParts');
            Route::post('/get-item-type', 'ItemPartsController@getItemType')->name('getItem.type');
            Route::post('/add-productItem-parts', 'ItemPartsController@addProductTypeParts');
            Route::get('/edit-itemParts/{id}','ItemPartsController@editItemParts');
            Route::post('/update-Item-parts','ItemPartsController@updateItemParts');
            Route::get('delete-itemParts/{id}', 'ItemPartsController@itemPartsDelete')->name('itemParts.delete');
            /*
        |--------------------------------------------------------------------------
        | Item Parts Controller  Route End
        |--------------------------------------------------------------------------
        */

            /*
        |--------------------------------------------------------------------------
        | Banner Controller  Route Start
        |--------------------------------------------------------------------------
        */
                                            /*=====Slider======*/
            Route::get('/banner-details', 'BannerController@bannerDetails')->name('banner-details');
            Route::post('/banner-slider-create', 'BannerController@sliderCreate')->name('banner-slider-create');
            Route::get('/banner-slider-edit/{id}', 'BannerController@sliderEdit')->name('banner-slider-edit');
            Route::post('/banner-slider-update', 'BannerController@sliderUpdate')->name('banner-slider-update');
            Route::get('/banner-slider-delete/{id}', 'BannerController@sliderDelete')->name('banner-slider-delete');

                                            /*=====Right Side Image======*/
            Route::post('/banner-right-side-create', 'BannerController@rightSideCreate')->name('banner-right-side-create');
            Route::get('/banner-rightSide-edit/{id}', 'BannerController@rightSideEdit')->name('banner-rightSide-edit');
            Route::post('/banner-rightSide-update', 'BannerController@rightSideUpdate')->name('banner-rightSide-update');
            Route::get('/banner-rightSide-delete/{id}', 'BannerController@rightSideDelete')->name('banner-rightSide-delete');

        /*
        |--------------------------------------------------------------------------
        | Banner Controller  Route End
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | Home Image Controller  Route Start
        |--------------------------------------------------------------------------
        */

        Route::get('/homeImage-details', 'HomeImagesController@imageDetails')->name('home-image-details');
        Route::post('/homeImage-create', 'HomeImagesController@HomeImageCreate')->name('home-image-create');
        Route::post('/update-homeImage-status', 'HomeImagesController@updateHomeImageStatus')->name('update-homeImage-status');
        Route::get('/homeImage-edit/{id}', 'HomeImagesController@homeImageEdit')->name('homeImage-edit');
        Route::post('/home-image-update', 'HomeImagesController@homeImageUpdate')->name('home-image-update');
            /*
        |--------------------------------------------------------------------------
        | Home Image Controller  Route End
        |--------------------------------------------------------------------------
        */
            /*
        |--------------------------------------------------------------------------
        | Dscount Controller  Route Start
        |--------------------------------------------------------------------------
        */

            Route::get('/discount-details', 'DiscountController@discountDetails')->name('discount-details');
            Route::post('/coupon-create', 'DiscountController@couponCreate')->name('coupon-create');
            Route::get('/edit/coupon/{id}', 'DiscountController@editCoupon');
            Route::post('/coupon-update', 'DiscountController@updateCoupon')->name('coupon-update');
            Route::get('/coupon-delete/{id}', 'DiscountController@couponDelete')->name('coupon-delete');

            /*
        |--------------------------------------------------------------------------
        | Dscount Controller  Route End
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | Order Controller  Route Start
        |--------------------------------------------------------------------------
        */
        Route::get('/onlinePayment/order', 'OrderController@onlinePayment')->name('online-order');
        Route::get('online/edit/order/{id}', 'OrderController@onlineEditOrder')->name('edit-order');
        Route::post('/update/order/', 'OrderController@orderUpdate')->name('order.update');

        Route::get('/offlinePayment/order', 'OrderController@cashOnDelivery')->name('offline-order');

        Route::get('/confirmd/order', 'OrderController@confirmdOrder')->name('confirmd-order');
        Route::get('confirmed/edit/order/{id}', 'OrderController@editConfirmedOrder')->name('confirmed-edit-order');
        Route::post('/update/confirmed/order/', 'OrderController@confirmedOrderUpdate')->name('confirmedOrder.update');

        Route::get('/view/order/{id}', 'OrderController@viewOrderDetails')->name('view-order');

        Route::get('/cancelled/order', 'OrderController@cacelledOrder')->name('cancelled-order');
        Route::get('/delivered/order', 'OrderController@deliveredOrder')->name('delivered-order');

        Route::get('/pdf/download/by/admin/{order_id}', 'OrderController@pdfDownload')->name('admin-pdfDownload-order');
        /*
        |--------------------------------------------------------------------------
        | Order Controller  Route End
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | PcComponent Controller  Route Start
        |--------------------------------------------------------------------------
        */
        Route::get('/pc-build/component', 'PCBuildComponentController@pcBuildComponent')->name('pc-build.component');
        Route::post('/add/component', 'PCBuildComponentController@addPcComponent')->name('add.component');
        Route::get('/edit/component/{id}', 'PCBuildComponentController@editPcComponent')->name('edit.component');
        Route::post('/update/component/', 'PCBuildComponentController@updatePcComponent')->name('update.component');
        Route::get('/delete/component/{id}', 'PCBuildComponentController@deletePcComponent')->name('delete-component');
        /*
        |--------------------------------------------------------------------------
        | PcComponent Controller  Route End
        |--------------------------------------------------------------------------
        */
            /*
        |--------------------------------------------------------------------------
        | Information Controller  Route Start
        |--------------------------------------------------------------------------
        */
        Route::get('about/information/', 'InformationController@about')->name('about-information');
        Route::post('about/create/', 'InformationController@aboutCreate')->name('about-create');
        Route::post('update/about/', 'InformationController@updateAbout')->name('update-about');


        Route::get('front/page/seo', 'InformationController@frontPageSeo')->name('front-page-seo');
        Route::post('front/page/seo/create/', 'InformationController@frontPageSeoCreate')->name('front-page-seo-create');
        Route::post('update/frontPage/', 'InformationController@updateFrontPage')->name('update-front-page');

        Route::get('terms/and/conditons', 'InformationController@termsCondition')->name('terms-conditions');
        Route::post('terms/and/conditons/create/', 'InformationController@termsConditionCreate')->name('terms-create');
        Route::post('update/terms/and/conditons', 'InformationController@updateTermsConditionPage')->name('update-terms');

        Route::get('payment/policy', 'InformationController@payment')->name('payment-policy');
        Route::post('payment/create/', 'InformationController@paymentCreate')->name('payment-create');
        Route::post('update/payment/policy', 'InformationController@updatePayment')->name('update-payment');

        Route::get('emi/information/', 'InformationController@emiInformation')->name('emi-information');
        Route::post('emi/create/', 'InformationController@emiCreate')->name('emi-create');
        Route::post('emi/about/', 'InformationController@emiUpdate')->name('emi-about');

        Route::get('privacy/information/', 'InformationController@privacyInformation')->name('privacy-information');
        Route::post('privacy/create/', 'InformationController@privacyCreate')->name('privacy-create');
        Route::post('privacy/about/', 'InformationController@privacyUpdate')->name('privacy-about');

        Route::get('return/refund/information/', 'InformationController@returnRefundInformation')->name('return-refund-information');
        Route::post('return/refund/create/', 'InformationController@returnRefundCreate')->name('return-refund-create');
        Route::post('return/refund//about/', 'InformationController@returnRefundUpdate')->name('return-refund-about');

        Route::get('delivery/policy/', 'InformationController@deliveryPolicy')->name('delivery-policy');
        Route::post('delivery/policy/create/', 'InformationController@deliveryPolicyCreate')->name('delivery-policy-create');
        Route::post('delivery/policy/about/', 'InformationController@deliveryPolicyUpdate')->name('delivery-policy-update');

        Route::get('job/circular/information/', 'InformationController@jobCircularInformation')->name('job-circular-information');
        Route::post('job/circular/create/', 'InformationController@jobCircularCreate')->name('job-circular-create');
        Route::post('job/circular/about/', 'InformationController@jobCircularUpdate')->name('job-circular-about');

        Route::get('mission/vision/information/', 'InformationController@missionVisionInformation')->name('mission-vision-information');
        Route::post('mission/vision/create/', 'InformationController@missionVisionCreate')->name('mission-vision-create');
        Route::post('mission/vision/about/', 'InformationController@missionVisionUpdate')->name('mission-vision-about');

        Route::get('contact/information', 'InformationController@contactInformation')->name('contact-information');
        Route::get('contact/add', 'InformationController@contactAdd')->name('contact-add');
        Route::get('contact/edit/{id}', 'InformationController@contactEdit')->name('contact-edit');
        Route::post('contact/information/create/', 'InformationController@contactCreate')->name('contact-create');
        Route::post('contact/information/update', 'InformationController@contactUpdate')->name('contact-update');
        Route::post('contact/status/update', 'InformationController@contactStatusUpdate')->name('contact-status');
        Route::get('contact/delete/{id}', 'InformationController@contactDelete')->name('contact-delete');

        Route::get('scroll/information', 'InformationController@scrollInformation')->name('scroll-information');
        Route::get('scroll/add', 'InformationController@scrollAdd')->name('scroll-add');
        Route::get('scroll/edit/{id}', 'InformationController@scrollEdit')->name('scroll-edit');
        Route::post('scroll/information/create/', 'InformationController@scrollCreate')->name('scroll-create');
        Route::post('scroll/information/update', 'InformationController@scrollUpdate')->name('scroll-update');
        Route::post('scroll/status/update', 'InformationController@scrollStatusUpdate')->name('scroll-status');
        Route::get('scroll/delete/{id}', 'InformationController@scrollDelete')->name('scroll-delete');
            /*
        |--------------------------------------------------------------------------
        | Information Controller  Route End
        |--------------------------------------------------------------------------
        */
            /*
        |--------------------------------------------------------------------------
        | Review Controller  Route Start
        |--------------------------------------------------------------------------
        */
            Route::get('user/review', 'ReviewController@review')->name('user.review.list');
            Route::post('update/status/review', 'ReviewController@updateReviewStatus')->name('update-review-status');
            Route::get('delete/user/review/{id}', 'ReviewController@deleteReview')->name('delete-review');

            //user question part route start
            Route::get('all/user/question', 'ReviewController@questionList')->name('all.question');
            Route::get('delete/user/question/{id}', 'ReviewController@deleteQuestion')->name('delete.question');
            Route::get('answe/page/{id}', 'ReviewController@editAnswer')->name('answer.page');
            Route::post('user/question/answer', 'ReviewController@questionAnswer')->name('send.question.answer');
            //user question part route end

        /*
        |--------------------------------------------------------------------------
        | Review Controller  Route End
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | Offer Controller  Route Start
        |--------------------------------------------------------------------------
        */
        Route::get('all/offer', 'OfferController@offers')->name('all.offer');
        Route::post('create/offer', 'OfferController@createOffer')->name('offer.create');
        Route::get('edit/offer/{offer_id}', 'OfferController@editOffer')->name('edit.offer');
        Route::post('update/offer/status', 'OfferController@updateofferStatus')->name('update-offer-status');
        Route::get('offer/delete/{id}', 'OfferController@deleteOffer')->name('delete-offer');
        Route::post('offer/update', 'OfferController@updateOffer')->name('offer.update');
        /*
        |--------------------------------------------------------------------------
        | Offer Controller  Route end
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | E-learning project start Backend part
        |--------------------------------------------------------------------------
        */
            Route::resource('course-category', 'CourseCategoryController');
            Route::resource('course', 'CourseController');
            Route::get('create-lesson/{id}', 'CourseController@courseLesson')->name('show-all-course-lesson');
            Route::post('store-lesson', 'CourseController@storeLesson')->name('store-course-lesson');
            Route::resource('exam-event', 'ExamEventController');
            Route::get('exam/create/question/{exam_id}', 'ExamEventController@questionForm')->name('exam-question');
            Route::post('exam/question/store', 'ExamEventController@questionStore')->name('exam-question-store');
            Route::get('exam/question/edit/{exam_id}/{question_id}', 'ExamEventController@questionEdit')->name('exam-question-edit');
            Route::get('exam/question/delete/{exam_id}/{question_id}', 'ExamEventController@questionDelete')->name('exam-question-delete');
            Route::post('exam/question/update', 'ExamEventController@questionUpdate')->name('exam-question-update');
            Route::get('exam/question/answer/{exam_id}/{question_id}', 'ExamEventController@answer')->name('exam-question-answer');
            Route::post('question/answer/store', 'ExamEventController@answerStore')->name('question-answer-store');
            Route::get('question/answer/edit/{answer_id}', 'ExamEventController@answerEdit')->name('question-answer-edit');
            Route::post('question/answer/update', 'ExamEventController@answerUpdate')->name('question-answer-update');
            Route::get('question/answer/delete/{id}', 'ExamEventController@answerDelete')->name('question-answer-delete');
            Route::get('exam/request', 'ExamEventController@examRequest')->name('exam-request');
            Route::post('exam/confirm', 'ExamEventController@examConfirm')->name('exam-confirm');
            Route::get('all/exam/report', 'ExamEventController@examReport')->name('exam-report');
            Route::post('all/show/exam/report', 'ExamEventController@showSearchData')->name('show-search-data');
            Route::get('all/exam/result', 'ExamEventController@allExamResult')->name('all-exam-result');
            Route::post('publish/result', 'ExamEventController@publishExamResult')->name('publish-result');
            Route::get('course/review/list', 'CourseController@courseReview')->name('course-review-list');
            Route::get('course/review/status/update/{id}', 'CourseController@reviewUpdate')->name('review-update');

        });
    });
});

/*
|--------------------------------------------------------------------------
| Frontend Routes Start
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Frontend'], function () {
    /*
    |--------------------------------------------------------------------------
    | Frontend Controller Routes Start
    |--------------------------------------------------------------------------
    */
    Route::get('/original', 'FrontendController@index')->name('frontend.home');
    Route::get('/search-result', 'FrontendController@allSearchResult')->name('search.result');
    Route::get('/about-us', 'FrontendController@aboutUs')->name('about.us');
    Route::get('/emi-policy', 'FrontendController@emiInformation')->name('emi.policy');
    Route::get('/privacy-policy', 'FrontendController@privacyInformation')->name('privacy.policy');
    Route::get('/mission-vision', 'FrontendController@missionVision')->name('mission.vision');
    Route::get('/return-refund', 'FrontendController@returnRefund')->name('return.refund');
    Route::get('/job-circular', 'FrontendController@jobCircular')->name('job.circular');
    Route::get('/terms-and-conditions', 'FrontendController@termsConditon')->name('terms.condition');
    Route::get('/contact-us', 'FrontendController@contactWithUs')->name('contact.us');
    Route::get('/payment-policy', 'FrontendController@paymentPolicy')->name('payment.policy');
    Route::get('/delivery-policy', 'FrontendController@deliveryPolicy')->name('delivery.policy');
    Route::get('/all-brands', 'FrontendController@allBrands')->name('all.brands');
    Route::get('/sitemap', 'FrontendController@siteMap')->name('site.map');
    Route::get('/main/banner-details/{id}', 'FrontendController@bannerPage')->name('banner.page');
    Route::get('our/services/', 'FrontendController@service')->name('our.service');
    Route::get('our/offers/', 'FrontendController@offers')->name('our.offers');
    Route::get('our/offers/{slug}', 'FrontendController@offerDetails')->name('our.offers.details');
    Route::get('/blog/page', 'FrontendController@blog')->name('blog.page');
    Route::get('/sitemap.xml', 'FrontendController@siteMapXml');


    /*
    |--------------------------------------------------------------------------
    | Frontend Controller Routes End
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | Compare Controller Routes Start
    |--------------------------------------------------------------------------
    */
    Route::get('/product/compare', 'CompareController@compare')->name('product.compare');
    Route::post('/add/compare', 'CompareController@addCompare')->name('add.compare');
    /*
    |--------------------------------------------------------------------------
    | Compare Controller Routes Ebd
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | Customer Controller Routes Start
    |--------------------------------------------------------------------------
    */
    Route::post('/user/review', 'CustomerController@reviewCreate')->name('user.review');
        //user question part route start
    Route::post('user/question', 'CustomerController@questionCreate')->name('user.question');
        //user question part route end
    /*
    |--------------------------------------------------------------------------
    | Customer Controller Routes End
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Product Controller Routes Start
    |--------------------------------------------------------------------------
    */


    Route::get('/category/{slug}', 'ProductController@listing')->name('header-menu');
    Route::get('/section/{section_slug}', 'ProductController@sectionProduct')->name('section-menu');


    Route::get('/product/{slug}', 'ProductController@productDetails')->name('product-details');
    Route::get('/brand/{slug}', 'ProductController@brandProduct')->name('all-brand-product');

    /*
    |--------------------------------------------------------------------------
    | Product Controller Routes End
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Cart Controller Routes Start
    |--------------------------------------------------------------------------
    */

    Route::get('/delete/cart/item/{id}', 'CartController@deleteCartItem')->name('delete.cart.item');
    Route::post('/add-to-cart', 'CartController@addToCart')->name('add-to-cart');
    Route::post('/update/cart', 'CartController@updateCartItem')->name('update.cart.item');
    /*
    |--------------------------------------------------------------------------
    | Cart Controller Routes End
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => ['ecomUser']], function () {
        /*
        |--------------------------------------------------------------------------
        | Customer Controller Routes Start
        |--------------------------------------------------------------------------
        */
    Route::get('ecom/user/dashboard', 'CustomerController@myAccount')->name('my.account');
    Route::get('/my/invoice/{oredr_id}', 'CustomerController@invoice')->name('my.invoice');
    Route::get('/cart/view', 'CartController@viewCart')->name('cart-view');
    Route::get('/cart/view/{coupon_name}', 'CartController@viewCart')->name('cart-view');
    Route::get('/cart/item/empty', 'CartController@emptyCart')->name('empty-cart-view');


    Route::get('/invoice/pdf/{oredr_id}', 'CustomerController@pdfDownload')->name('pdf.download');
    Route::get('/ecom/user/details', 'CustomerController@ecomUserDetails')->name('ecom-user-details');
    Route::post('update/ecom/user/details', 'EcomUserController@updateEcomUserDetails')->name('update-ecomUser');
    Route::get('/ecom/order/history', 'CustomerController@orderHistory')->name('order-history');
    Route::get('/ecom/order/status', 'CustomerController@orderStatus')->name('user-thankyou');
    Route::get('/ecom/order/unsuccess/status', 'CustomerController@unsuccessStatus')->name('user-sorry');
    Route::get('/ecom/user/change/password', 'CustomerController@changePassword')->name('user-change-password');
    Route::post('/ecom/user/check/currentPwd', 'CustomerController@checkCurrentPassword')->name('user-check-currentPwd');
    Route::post('/ecom/user/update/password', 'CustomerController@updateCurrentPwd')->name('user-update-password');
    Route::get('/ecom/user/cancelled/order', 'CustomerController@cancelldeOrder')->name('cannceld-orders');
    Route::get('/ecom/user/transactions', 'CustomerController@transectionHistory')->name('transaction-history');

    /*
    |--------------------------------------------------------------------------
    | Customer Controller Routes End
    |--------------------------------------------------------------------------
    */
    });
    /*
    |--------------------------------------------------------------------------
    | pc build Controller Routes Start
    |--------------------------------------------------------------------------
    */
    Route::get('/pc-build', 'PcBuildController@pcBuild')->name('pc.build');
    Route::get('/choose/componet/{component_id}', 'PcBuildController@componentProduct')->name('component.product');
    Route::post('/add-to/pc-build', 'PcBuildController@addToPcBuild')->name('add-to-pcBuild');
    Route::get('/remove/component-product/{id}', 'PcBuildController@removeComponentProduct')->name('remove.component.product');
    Route::get('/print/pc/build/{session_id}', 'PcBuildController@printPcBuild')->name('print.pc.build');
    Route::get('/pc/build/addToCart', 'PcBuildController@addToCart')->name('pc.build.addToCart');

    /*
    |--------------------------------------------------------------------------
    | pc build Controller Routes End
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | Ecom User Controller Routes Start
    |--------------------------------------------------------------------------
    */
//    Route::match(['get', 'post'], '/ecom/user/login', 'EcomUserController@login');
//    Route::post('/ecom/user/register', 'EcomUserController@registration');
//    Route::get('/ecom/user/registration', 'EcomUserController@registrationPage');
//    Route::get('/ecom/user/logout', 'EcomUserController@logout')->name('ecom-user-logout');
//    Route::match(['get', 'post'], '/user/forgot/password', 'EcomUserController@forgotPassword')->name('user-forgot-password');
//    Route::get('ecom/user/verification-code', 'EcomUserController@verificationCode')->name('verification-code');
//    Route::post('ecom/user/mobile-otp', 'EcomUserController@mobileOtp')->name('mobileOtp-code');
    /*
    |--------------------------------------------------------------------------
    | Ecom User Controller Routes End
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => ['ecomUser']], function () {
        Route::get('checkout/page/{slug}', 'HomeController@checkoutPage')->name('checkout-page');
        Route::post('checkout/confirm', 'HomeController@checkoutConfirm')->name('checkout-confirm');

        /*user profile*/
        Route::get('student/profile', 'StudentController@studentProfile')->name('student-profile');
        Route::get('student/Dashboard', 'StudentController@studentDashboard')->name('student-dashboard');
        Route::get('student/exams', 'StudentController@studentExams')->name('student-exams');
        Route::get('student/exam/start/{exam_id}', 'StudentController@examStart')->name('exam-start');
        Route::post('store/question/answer', 'StudentController@storeQuestionAnswer')->name('store-question-answer');
        Route::get('student/account/page', 'StudentController@accountPage')->name('student-account-page');
        Route::get('student/invoice/page', 'StudentController@invoicePage')->name('student-invoice-page');
        Route::post('student/change/password', 'StudentController@StudentChangePassword')->name('student-change-password');
        Route::get('student/course/enroll/{id}', 'StudentController@StudentCourseEnroll')->name('course-enroll');
        Route::get('student/course', 'StudentController@studentCourses')->name('student-courses');
        Route::post('student/course/review', 'StudentController@courseReview')->name('course-review-store');

    });
    /*
   |--------------------------------------------------------------------------
   | E-learning project start frontend part
   |--------------------------------------------------------------------------
   */
    Route::get('/', 'HomeController@eHome')->name('elearning-home');
    Route::get('student/course/details/{slug}', 'HomeController@courseDetails')->name('student-course-details');
    Route::resource('student', 'StudentController');

    Route::get('otp-verification/page', 'StudentController@verificationPage')->name('otp-verification-page');
    Route::post('otp-verification/code', 'StudentController@otpVerification')->name('verify-otp');
    Route::get('student/logout/page', 'StudentController@studentLogout')->name('student-logout');
    Route::match(['get', 'post'], 'login/students', 'StudentController@studentLoginPage');
    Route::get('all/exams', 'HomeController@allExam')->name('all-exam-list');
    Route::get('course/category/search/{slug}', 'HomeController@searchCourseCategory')->name('search-course-by-category');
    Route::get('course/search', 'HomeController@searchCourse')->name('search-course');
    Route::get('student/forget/password', 'StudentController@forgetPassword')->name('student-forget-password');
    Route::match(['get', 'post'], 'student/send/password', 'StudentController@sendPassword')->name('send-password');
    Route::get('student/invoice/download/{id}', 'StudentController@studentInvoiceDownload')->name('student-invoice-download');
    Route::get('exam/policy', 'HomeController@examPolicy')->name('exam-policy');


});

/*
|--------------------------------------------------------------------------
| Frontend Routes End
|--------------------------------------------------------------------------
*/

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// SSLCOMMERZ Start
//Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
//Route::post('user/checkout/', 'SslCommerzPaymentController@exampleHostedCheckout')->name('checkout');
//Route::post('/pay', 'SslCommerzPaymentController@index');
//
//
//Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
//
//Route::post('/success', 'SslCommerzPaymentController@success');
//Route::post('/fail', 'SslCommerzPaymentController@fail');
//Route::post('/cancel', 'SslCommerzPaymentController@cancel');
//
//Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END
