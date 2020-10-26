<?php
use App\Http\Controllers\LanguageController;
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

    // Dashboard Route

Route::get('/', function () {
    return view('/pages/dashboard-analytics');
})->middleware('auth');
Route::get('/profile', 'ProfileController@index');
Auth::routes();
Route::get('/modern', 'DashboardController@dashboardModern');
Route::get('/ecommerce', 'DashboardController@dashboardEcommerce');
Route::get('/analytics', 'DashboardController@dashboardAnalytics');
Route::get('/access-control', 'AccessController@index');
Route::get('/access-control/{roles}', 'AccessController@roles');
Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');

Route::group(['middleware' => ['auth']], function() {
// Application Route
Route::get('/app-email', 'ApplicationController@emailApp');
Route::get('/app-email/content/{inbox_id}', 'ApplicationController@emailContentApp');
Route::get('/app-chat', 'ApplicationController@chatApp');
Route::get('/app-todo', 'ApplicationController@todoApp');
Route::get('/app-kanban', 'ApplicationController@kanbanApp');
Route::get('/app-file-manager', 'ApplicationController@fileManagerApp');
Route::get('/app-contacts', 'ApplicationController@contactApp');
Route::get('/app-calendar', 'ApplicationController@calendarApp');
Route::get('/app-invoice-list', 'ApplicationController@invoiceList');
Route::get('/app-invoice-view', 'ApplicationController@invoiceView');
Route::get('/app-invoice-edit', 'ApplicationController@invoiceEdit');
Route::get('/app-invoice-add', 'ApplicationController@invoiceAdd');
Route::get('/eCommerce-products-page', 'ApplicationController@ecommerceProduct');
Route::get('/eCommerce-pricing', 'ApplicationController@eCommercePricing');

// User profile Route
Route::get('/user-profile-page/{id}', 'UserProfileController@userProfile');

// Page Route
Route::get('/page-contact', 'PageController@contactPage');
Route::get('/page-blog-list', 'PageController@pageBlogList');
Route::get('/page-search', 'PageController@searchPage');
Route::get('/page-knowledge', 'PageController@knowledgePage');
Route::get('/page-knowledge/licensing', 'PageController@knowledgeLicensingPage');
Route::get('/page-knowledge/licensing/detail', 'PageController@knowledgeLicensingPageDetails');
Route::get('/page-timeline', 'PageController@timelinePage');
Route::get('/page-faq', 'PageController@faqPage');
Route::get('/page-faq-detail', 'PageController@faqDetailsPage');
Route::get('/page-account-settings/{id}', 'PageController@accountSetting');
Route::get('/page-blank', 'PageController@blankPage');
Route::get('/page-collapse', 'PageController@collapsePage');

// Media Route
Route::get('/media-gallery-page', 'MediaController@mediaGallery');
Route::get('/media-hover-effects', 'MediaController@hoverEffect');



// Authentication Route
Route::get('/user-login', 'AuthenticationController@userLogin');
Route::get('/user-login', 'AuthenticationController@userLogin');
Route::get('/user-register', 'AuthenticationController@userRegister');
Route::get('/user-forgot-password', 'AuthenticationController@forgotPassword');
Route::get('/user-lock-screen', 'AuthenticationController@lockScreen');


// Misc Route
Route::get('/page-404', 'MiscController@page404');
Route::get('/page-maintenance', 'MiscController@maintenancePage');
Route::get('/page-500', 'MiscController@page500');

// Card Route
Route::get('/cards-basic', 'CardController@cardBasic');
Route::get('/cards-advance', 'CardController@cardAdvance');
Route::get('/cards-extended', 'CardController@cardsExtended');

// Css Route
Route::get('/css-typography', 'CssController@typographyCss');
Route::get('/css-color', 'CssController@colorCss');
Route::get('/css-grid', 'CssController@gridCss');
Route::get('/css-helpers', 'CssController@helpersCss');
Route::get('/css-media', 'CssController@mediaCss');
Route::get('/css-pulse', 'CssController@pulseCss');
Route::get('/css-sass', 'CssController@sassCss');
Route::get('/css-shadow', 'CssController@shadowCss');
Route::get('/css-animations', 'CssController@animationCss');
Route::get('/css-transitions', 'CssController@transitionCss');

// Basic Ui Route
Route::get('/ui-basic-buttons', 'BasicUiController@basicButtons');
Route::get('/ui-extended-buttons', 'BasicUiController@extendedButtons');
Route::get('/ui-icons', 'BasicUiController@iconsUI');
Route::get('/ui-alerts', 'BasicUiController@alertsUI');
Route::get('/ui-badges', 'BasicUiController@badgesUI');
Route::get('/ui-breadcrumbs', 'BasicUiController@breadcrumbsUI');
Route::get('/ui-chips', 'BasicUiController@chipsUI');
Route::get('/ui-chips', 'BasicUiController@chipsUI');
Route::get('/ui-collections', 'BasicUiController@collectionsUI');
Route::get('/ui-navbar', 'BasicUiController@navbarUI');
Route::get('/ui-pagination', 'BasicUiController@paginationUI');
Route::get('/ui-preloader', 'BasicUiController@preloaderUI');

// Advance UI Route
Route::get('/advance-ui-carousel', 'AdvanceUiController@carouselUI');
Route::get('/advance-ui-collapsibles', 'AdvanceUiController@collapsibleUI');
Route::get('/advance-ui-toasts', 'AdvanceUiController@toastUI');
Route::get('/advance-ui-tooltip', 'AdvanceUiController@tooltipUI');
Route::get('/advance-ui-dropdown', 'AdvanceUiController@dropdownUI');
Route::get('/advance-ui-feature-discovery', 'AdvanceUiController@discoveryFeature');
Route::get('/advance-ui-media', 'AdvanceUiController@mediaUI');
Route::get('/advance-ui-modals', 'AdvanceUiController@modalUI');
Route::get('/advance-ui-scrollspy', 'AdvanceUiController@scrollspyUI');
Route::get('/advance-ui-tabs', 'AdvanceUiController@tabsUI');
Route::get('/advance-ui-waves', 'AdvanceUiController@wavesUI');
Route::get('/fullscreen-slider-demo', 'AdvanceUiController@fullscreenSlider');

// Extra components Route
Route::get('/extra-components-range-slider', 'ExtraComponentsController@rangeSlider');
Route::get('/extra-components-sweetalert', 'ExtraComponentsController@sweetAlert');
Route::get('/extra-components-nestable', 'ExtraComponentsController@nestAble');
Route::get('/extra-components-treeview', 'ExtraComponentsController@treeView');
Route::get('/extra-components-ratings', 'ExtraComponentsController@ratings');
Route::get('/extra-components-tour', 'ExtraComponentsController@tour');
Route::get('/extra-components-i18n', 'ExtraComponentsController@i18n');
Route::get('/extra-components-highlight', 'ExtraComponentsController@highlight');

// Basic Tables Route
Route::get('/table-basic', 'BasicTableController@tableBasic');

// Data Table Route
Route::get('/table-data-table', 'DataTableController@dataTable');

// Form Route
Route::get('/form-elements', 'FormController@formElement');
Route::get('/form-select2', 'FormController@formSelect2');
Route::get('/form-validation', 'FormController@formValidation');
Route::get('/form-masks', 'FormController@masksForm');
Route::get('/form-editor', 'FormController@formEditor');
Route::get('/form-file-uploads', 'FormController@fileUploads');
Route::get('/form-layouts', 'FormController@formLayouts');
Route::get('/form-wizard', 'FormController@formWizard');

// Charts Route
Route::get('/charts-chartjs', 'ChartController@chartJs');
Route::get('/charts-chartist', 'ChartController@chartist');
Route::get('/charts-sparklines', 'ChartController@sparklines');

//networks

Route::prefix('/')->group(function () { 
            Route::get('networks', 'NetworkController@index')->name('networks.index');
			Route::post('/networks/store','NetworkController@store')->name('networks.store');
            Route::get('/networks/edit/{id}','NetworkController@edit')->name('networks.edit');
            Route::put('/networks/update/{id}', 'NetworkController@update')->name('networks.update');
            Route::get('/networks/delete/{id}', 'NetworkController@delete')->name('networks.delete');
            Route::get('/networks/create', 'NetworkController@create')->name('networks.create');
            Route::get('/networks/show/{id}','NetworkController@show')->name('networks.show');
            Route::get('/networks/goNetwork/{id}','NetworkController@goNetwork')->name('networks.goNetwork');
            Route::get('/networks/goNetworkOffre/{id}','NetworkController@goNetworkOffre')->name('networks.goNetworkOffre');
            Route::get('/networks/Offrenetwork/{id}','NetworkController@Offrenetwork')->name('networks.Offrenetwork');
            Route::get('get-curl', 'NetworkController@getCURL')->name('networks.getCURL'); 
        });	
		
		
//domains		
Route::prefix('/')->group(function () { 
            Route::get('domains', 'DomainController@index')->name('domains.index');
			Route::post('/domains/store','DomainController@store')->name('domains.store');
            Route::get('/domains/edit/{id}','DomainController@edit')->name('domains.edit');
            Route::put('/domains/update/{id}', 'DomainController@update')->name('domains.update');
            Route::get('/domains/delete/{id}', 'DomainController@delete')->name('domains.delete');
            Route::get('/domains/create', 'DomainController@create')->name('domains.create');
            Route::get('/domains/show','DomainController@show')->name('domains.show');
             
        });	
		
//providers
Route::prefix('/')->group(function () { 
            Route::get('providers', 'ProviderController@index')->name('providers.index');
			Route::post('/providers/store','ProviderController@store')->name('providers.store');
            Route::get('/providers/edit/{id}','ProviderController@edit')->name('providers.edit');
            Route::put('/providers/update/{id}', 'ProviderController@update')->name('providers.update');
            Route::get('/providers/delete/{id}', 'ProviderController@delete')->name('providers.delete');
            Route::get('/providers/create', 'ProviderController@create')->name('providers.create');
            Route::get('/providers/show','ProviderController@show')->name('providers.show');
             
        });
		
//isps		
Route::prefix('/')->group(function () { 
            Route::get('isps', 'IspController@index')->name('isps.index');
			Route::post('/isps/store','IspController@store')->name('isps.store');
            Route::get('/isps/edit/{id}','IspController@edit')->name('isps.edit');
            Route::put('/isps/update/{id}', 'IspController@update')->name('isps.update');
            Route::get('/isps/delete/{id}', 'IspController@delete')->name('isps.delete');
            Route::get('/isps/create', 'IspController@create')->name('isps.create');
            Route::get('/isps/show','IspController@show')->name('isps.show');
             
        });
		
		
//countrys		
Route::prefix('/')->group(function () { 
            Route::get('countrys', 'CountryController@index')->name('countrys.index');
			Route::post('/countrys/store','CountryController@store')->name('countrys.store');
            Route::get('/countrys/edit/{id}','CountryController@edit')->name('countrys.edit');
            Route::put('/countrys/update/{id}', 'CountryController@update')->name('countrys.update');
            Route::get('/countrys/delete/{id}', 'CountryController@delete')->name('countrys.delete');
            Route::get('/countrys/create', 'CountryController@create')->name('countrys.create');
            Route::get('/countrys/show','CountryController@show')->name('countrys.show');
            Route::get('/countrys/indexflag','CountryController@indexflag')->name('countrys.indexflag');
             
        });	
		
		
//operatingsystems		
Route::prefix('/')->group(function () { 
            Route::get('operatingsystems', 'OperatingsystemController@index')->name('operatingsystems.index');
			Route::post('/operatingsystems/store','OperatingsystemController@store')->name('operatingsystems.store');
            Route::get('/operatingsystems/edit/{id}','OperatingsystemController@edit')->name('operatingsystems.edit');
            Route::put('/operatingsystems/update/{id}', 'OperatingsystemController@update')->name('operatingsystems.update');
            Route::get('/operatingsystems/delete/{id}', 'OperatingsystemController@delete')->name('operatingsystems.delete');
            Route::get('/operatingsystems/create', 'OperatingsystemController@create')->name('operatingsystems.create');
            Route::get('/operatingsystems/show','OperatingsystemController@show')->name('operatingsystems.show');
             
        });
		
//servers
Route::prefix('/')->group(function () { 
            Route::get('servers', 'ServerController@index')->name('servers.index');
			Route::post('/servers/store','ServerController@store')->name('servers.store');
            Route::get('/servers/edit/{id}','ServerController@edit')->name('servers.edit');
            Route::put('/servers/update/{id}', 'ServerController@update')->name('servers.update');
            Route::get('/servers/delete/{id}', 'ServerController@delete')->name('servers.delete');
            Route::get('/servers/create', 'ServerController@create')->name('servers.create');
            Route::get('/servers/createAuto/{id}', 'ServerController@createAuto')->name('servers.createAuto');
            Route::get('/servers/show/{id}','ServerController@show')->name('servers.show');
            
             
        });	
		
//reportings		
Route::prefix('/')->group(function () { 
            Route::get('reportings', 'ReportintoolController@index')->name('reportings.index');
			Route::post('/reportings/store','ReportintoolController@store')->name('reportings.store');
            Route::get('/reportings/edit/{id}','ReportintoolController@edit')->name('reportings.edit');
            Route::put('/reportings/update/{id}', 'ReportintoolController@update')->name('reportings.update');
            Route::get('/reportings/delete/{id}', 'ReportintoolController@delete')->name('reportings.delete');
            Route::get('/reportings/create', 'ReportintoolController@create')->name('reportings.create');
            Route::get('/reportings/show','ReportintoolController@show')->name('reportings.show');
             
        });
		
//imaps		
Route::prefix('/')->group(function () { 
            Route::get('imaps', 'ImapController@index')->name('imaps.index');
			Route::post('/imaps/store','ImapController@store')->name('imaps.store');
            Route::get('/imaps/edit/{id}','ImapController@edit')->name('imaps.edit');
            Route::put('/imaps/update/{id}', 'ImapController@update')->name('imaps.update');
            Route::get('/imaps/delete/{id}', 'ImapController@delete')->name('imaps.delete');
            Route::get('/imaps/create', 'ImapController@create')->name('imaps.create');
            Route::get('/imaps/show','ImapController@show')->name('imaps.show');
            Route::get('/imaps/getImapFromMail','ImapController@getImapFromMail')->name('imaps.getImapFromMail');
            Route::post('/imaps/getImap','ImapController@getImap')->name('imaps.getImap');

             
        });	
		
//sips
Route::prefix('/')->group(function () { 
            Route::get('sips', 'SipController@index')->name('sips.index');
			Route::post('/sips/store','SipController@store')->name('sips.store');
            Route::get('/sips/edit/{id}','SipController@edit')->name('sips.edit');
            Route::put('/sips/update/{id}', 'SipController@update')->name('sips.update');
            Route::get('/sips/delete/{id}', 'SipController@delete')->name('sips.delete');
            Route::get('/sips/create', 'SipController@create')->name('sips.create');
            Route::get('/sips/show/{id}','SipController@show')->name('sips.show');
			Route::get('/sips/AddDomain/{id}','SipController@AddDomain')->name('sips.AddDomain');
             
        });

//headers
Route::prefix('/')->group(function () { 
            Route::get('headers', 'HeaderController@index')->name('headers.index');
			Route::post('/headers/store','HeaderController@store')->name('headers.store');
            Route::get('/headers/edit/{id}','HeaderController@edit')->name('headers.edit');
            Route::put('/headers/update/{id}', 'HeaderController@update')->name('headers.update');
            Route::get('/headers/delete/{id}', 'HeaderController@delete')->name('headers.delete');
            Route::get('/headers/create', 'HeaderController@create')->name('headers.create');
            Route::get('/headers/show/{id}','HeaderController@show')->name('headers.show');
             
        });
		
//bodys
Route::prefix('/')->group(function () { 
            Route::get('bodys', 'BodyController@index')->name('bodys.index');
			Route::post('/bodys/store','BodyController@store')->name('bodys.store');
            Route::get('/bodys/edit/{id}','BodyController@edit')->name('bodys.edit');
            Route::put('/bodys/update/{id}', 'BodyController@update')->name('bodys.update');
            Route::get('/bodys/delete/{id}', 'BodyController@delete')->name('bodys.delete');
            Route::get('/bodys/create', 'BodyController@create')->name('bodys.create');
            Route::get('/bodys/show/{id}','BodyController@show')->name('bodys.show');
             
        });
		
		
//offres
Route::prefix('/')->group(function () { 
            Route::get('offres', 'OffreController@index')->name('offres.index');
			Route::post('/offres/store','OffreController@store')->name('offres.store');
            Route::get('/offres/edit/{id}','OffreController@edit')->name('offres.edit');
            Route::post('/offres/update/{id}', 'OffreController@update')->name('offres.update');
            Route::get('/offres/delete/{id}', 'OffreController@delete')->name('offres.delete');
            Route::get('/offres/create', 'OffreController@create')->name('offres.create');
            Route::get('/offres/show/{id}','OffreController@show')->name('offres.show');
            Route::get('/offres/createImage','OffreController@createImage')->name('offres.createImage');
			Route::get('/offres/SuppFile/{id}','OffreController@SuppFile')->name('offres.SuppFile');     
            Route::get('/offres/getOfferByNetwork/{id}', 'OffreController@getOfferByNetwork')->name('offres.getOfferByNetwork'); 
            Route::get('/offres/getImage/{id}','OffreController@getImage')->name('offres.getImage');
       
             
        });
//typelistes
Route::prefix('/')->group(function () { 
    Route::get('typelistes', 'TypelisteController@index')->name('typelistes.index');
    Route::post('/typelistes/store','TypelisteController@store')->name('typelistes.store');
    Route::get('/typelistes/edit/{id}','TypelisteController@edit')->name('typelistes.edit');
    Route::put('/typelistes/update/{id}', 'TypelisteController@update')->name('typelistes.update');
    Route::get('/typelistes/delete/{id}', 'TypelisteController@delete')->name('typelistes.delete');
    Route::get('/typelistes/create', 'TypelisteController@create')->name('typelistes.create');
    Route::get('/typelistes/show','TypelisteController@show')->name('typelistes.show');
     
});	  
//listesends   
Route::prefix('/')->group(function () { 
    Route::get('listesends', 'ListesendController@index')->name('listesends.index');
    Route::post('/listesends/store','ListesendController@store')->name('listesends.store');
    Route::post('/listesends/upload/{id}','ListesendController@upload')->name('listesends.upload');
    Route::get('/listesends/edit/{id}','ListesendController@edit')->name('listesends.edit');
    Route::get('/listesends/uploadData/{id}','ListesendController@uploadData')->name('listesends.uploadData');
    Route::put('/listesends/update/{id}', 'ListesendController@update')->name('listesends.update');
    Route::get('/listesends/delete/{id}', 'ListesendController@delete')->name('listesends.delete');
    Route::get('/listesends/create', 'ListesendController@create')->name('listesends.create');
    Route::get('/listesends/show','ListesendController@show')->name('listesends.show');
     
});	

//drops
Route::prefix('/')->group(function () { 
    Route::get('drops', 'DropController@index')->name('drops.index');
    Route::post('/drops/store','DropController@store')->name('drops.store');
    Route::get('/drops/edit/{id}','DropController@edit')->name('drops.edit');
    Route::put('/drops/update/{id}', 'DropController@update')->name('drops.update');
    Route::get('/drops/delete/{id}', 'DropController@delete')->name('drops.delete');
    Route::get('/drops/create', 'DropController@create')->name('drops.create');
    Route::get('/drops/show','DropController@show')->name('drops.show');
    Route::get('/drops/test','DropController@test')->name('drops.test');
    Route::get('/drops/ShowSend','DropController@ShowSend')->name('drops.ShowSend');
	Route::get('/json-offres','DropController@offres');
	Route::get('/json-listesends','DropController@listesends');
	Route::get('/json-datas','DropController@datas');
	Route::get('/json-files', 'DropController@files');
	Route::get('/json-headers', 'DropController@headers');
	Route::get('/json-bodys', 'DropController@bodys');
	Route::get('/json-ips','DropController@ips');
	Route::get('/testSlect', 'DropController@testSlect');

	// Route::get('/json-offres/{id}','DropController@offres');
	// Route::get('/json-files/{id}', 'DropController@files');

     
});
//sends
Route::prefix('/')->group(function () { 
    Route::get('sends', 'SendController@index')->name('sends.index');
    Route::post('/sends/store','SendController@store')->name('sends.store');
    Route::get('/sends/edit','SendController@edit')->name('sends.edit');
    Route::put('/sends/update/{id}', 'SendController@update')->name('sends.update');
    Route::get('/sends/delete/{id}', 'SendController@delete')->name('sends.delete');
    Route::get('/sends/create', 'SendController@create')->name('sends.create');
    Route::get('/sends/show','SendController@show')->name('sends.show');
	Route::get('/sends/send/{id}','SendController@send')->name('sends.send');
	
	
});	

//warms
Route::prefix('/')->group(function () { 
    Route::get('updatewarms', 'WarmController@index')->name('warms.index');
    Route::post('/warms/store','WarmController@store')->name('warms.store');
    Route::get('/warms/edit','WarmController@edit')->name('warms.edit');
    Route::put('/warms/update/{id}', 'WarmController@update')->name('warms.update');
    Route::get('/warms/delete/{id}', 'WarmController@delete')->name('warms.delete');
    Route::get('/warms/create', 'WarmController@create')->name('warms.create');
    Route::get('/warms/show','WarmController@show')->name('warms.show');
});

//creatives
Route::prefix('/')->group(function () { 
    Route::get('creatives', 'CreativeController@index')->name('creatives.index');
    Route::post('/creatives/store','CreativeController@store')->name('creatives.store');
    Route::get('/creatives/edit/{id}','CreativeController@edit')->name('creatives.edit');
    Route::put('/creatives/update/{id}', 'CreativeController@update')->name('creatives.update');
    Route::get('/creatives/delete/{id}', 'CreativeController@delete')->name('creatives.delete');
    Route::get('/creatives/create', 'CreativeController@create')->name('creatives.create');
    Route::get('/creatives/show','CreativeController@show')->name('creatives.show');
});

// User Route

Route::prefix('/')->group(function () { 
Route::get('/page-users-list', 'UserController@usersList')->name('users.page-users-list');
Route::get('/page-new-users-list', 'UserController@usersNewList')->name('users.page-new-users-list');
Route::get('/page-users-view/{id}', 'UserController@usersView')->name('users.page-users-view');
Route::get('/page-users-edit/{id}', 'UserController@usersEdit')->name('users.usersEdit');
Route::get('/delete/{id}', 'UserController@delete')->name('users.delete');
Route::put('/userUpdate/{id}', 'UserController@update')->name('users.userUpdate');
Route::get('/allUsers', 'UserController@allUsers')->name('users.allUsers');
Route::resource('users','UserController');
});
;
// locale route
Route::get('lang/{locale}',[LanguageController::class, 'swap']);


// Route::get('image-upload', 'ImageuploadController@image_upload')->name('image.upload');
// Route::post('image-upload', 'ImageuploadController@upload_post_image')->name('upload.post.image');
Route::get('files', 'FileController@index')->name('files.index');
Route::post('files', 'FileController@store')->name('files.store');

//roles
Route::prefix('/')->group(function () { 
    Route::get('roles', 'RoleController@index')->name('roles.index');
    Route::post('/roles/store','RoleController@store')->name('roles.store');
	Route::post('/roles/show/{id}','RoleController@show')->name('roles.show');
    Route::get('/roles/edit/{id}','RoleController@edit')->name('roles.edit');
    Route::put('/roles/update/{id}', 'RoleController@update')->name('roles.update');
    Route::get('/roles/delete/{id}', 'RoleController@delete')->name('roles.delete');
    Route::get('/roles/create', 'RoleController@create')->name('roles.create');
    Route::get('roles-has-permission','RoleController@show')->name('roles.show');
    Route::get('editRolePrermission/{id}','RoleController@editRolePrermission')->name('roles.editRolePrermission');
    Route::put('updateRolePrermission/{id}','RoleController@updateRolePrermission')->name('roles.updateRolePrermission');
});


//permissions
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/list', 'PermissionsController@list')->name('permissions.list');
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

//MailBox send
Route::post('/sendMail','InboxController@sendMail');
Route::get('/sent', 'ApplicationController@sent');

//MailBox deleted
Route::get('/deleted','ApplicationController@deleted');
Route::post('/delete-inboxes','InboxController@deleteInboxMails');
Route::get('/delete-sent/{inbox_id}','InboxController@deleteSentMail');
Route::post('/delete-sents','InboxController@deleteSentMails');
Route::get('remove-inbox/{inbox_id}','InboxController@deleteInboxMailPermanently');
Route::post('/remove-inboxes','InboxController@deleteInboxMailsPermanently');

//MailBox starred
Route::post('/starred-inboxes','InboxController@starredInboxMails');
Route::post('/starred-sents','InboxController@starredSentMails');
Route::get('/starred', 'ApplicationController@starred');
Route::get('/starred-sent/{inbox_id}','InboxController@starredSentMail');
Route::get('/starred-inbox/{inbox_id}','InboxController@starredInboxMail');
Route::get('move-inbox/{inbox_id}','InboxController@starredInboxMailPermanently');
Route::post('/move-inboxes','InboxController@starredInboxMailsPermanently');

//MailBox important
Route::post('/important-inboxes','InboxController@importantInboxMails');
Route::post('/important-sents','InboxController@importantSentMails');
Route::get('/important', 'ApplicationController@important');
Route::get('/important-sent/{inbox_id}','InboxController@importantSentMail');
Route::get('/important-inbox/{inbox_id}','InboxController@importantInboxMail');
Route::get('importantmove-inbox/{inbox_id}','InboxController@importantInboxMailPermanently');
Route::post('/importantmove-inboxes','InboxController@importantInboxMailsPermanently');
});