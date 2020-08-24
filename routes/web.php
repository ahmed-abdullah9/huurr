<?php

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


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// No Localization needed
Auth::routes();
Route::get('/my','DashboardController@test');
Route::post('login', 'Auth\LoginController@postLogin');
Route::post('register', 'Auth\RegisterController@store');
Route::post('forget/password/', 'Auth\LoginController@reset_password_forget');
Route::post('/reset/password/{reset_token?}', 'Auth\LoginController@reset_update_password');
Route::post('/subcription', 'HomeController@subcription');
Route::get('/get_skills/{lang?}', 'HomeController@get_skills');
Route::post('/get_started/freelancer', 'HomeController@set_get_started');
Route::post('/contact_submit', 'HomeController@contact_submit');
Route::post('/edit_skill_post', 'DashboardController@edit_post_skill');
Route::post('/post/sub_skill', 'DashboardController@post_sub_skill');
Route::get('/check_sub_skills/{id}', 'HomeController@view_sub_skills');
Route::post('update/freelancer/category', 'ProfileController@edit_fr_category');
Route::post('admin/paynow','PayfortController@paynow_fr');
Route::post('fr_amount/tranfer/','PayfortController@fr_amount_tansfer');
Route::get('/crownJob','PayfortController@crownjob');
Route::group(['middleware' => ['admin_auth']], function () {

    Route::post("submit/member",'TeamController@submit_member');
    Route::post('/update/member','TeamController@update_member');
    Route::post('/submit/portfolio','AdminPortfolioController@submit_portfolio');
    Route::post('update/portfolio','AdminPortfolioController@update_portfolio');
    Route::post('/update_option_new', 'DashboardController@update_option_with_admin');
    Route::get('delete/user/{user_id}','DashboardController@delete_user');
    Route::post('submit/fr/skills/','CategoryController@submit_skill');
    Route::post('update/fr/skills/','CategoryController@update_skill');
    Route::get('del/fr/skills/{skill_id}','CategoryController@del_skill');
    Route::post('/post/qouts', 'DashboardController@post_qouts');
    Route::post('/edit_qout_post', 'DashboardController@edit_post_qouts');
    Route::post('/post/skill', 'DashboardController@post_skill');
});
Route::group(['middleware' => ['client_auth']], function () {
    Route::get('fr/notification','MessageController@getallNotification');
    Route::get('/start/job/tasks/{proposal_id}/{proposal_user}','JobController@start_job_task');
    Route::get('cl/getConversation','MessageController@getConversation');
    Route::post('/job/skills','CategoryController@job_skills');

    Route::post('cl/get_frMessages','MessageController@get_frMessages');
    Route::post('cl/getclnewMessages','MessageController@getclnewMessages');
    Route::post('cl/cl_sendMessage','MessageController@cl_sendMessage');
    Route::post('submit/cl/feedback/','FeedbackController@save_cl_feedback');
    Route::post('cl/claimJob','JobController@post_claimJob');
    Route::post('cl/disclaimJob','JobController@disclaimJob');
    Route::post('/save/freelancer', 'ClientController@save_freelancer');
    Route::post('/select/type', 'JobController@jobpost_type');
    Route::post('jobpost/update', 'JobController@update_job');
    Route::post('createjob', 'JobController@createJob');
    Route::post('createinvitepostjob', 'JobController@createinvitepostjob');
    Route::post('/hire/freelancer', 'JobController@hire_new_freelancer');
    Route::post('/invite_free/freelancer', 'JobController@hire_freelancer');
    Route::post('invite_user', 'JobController@invite_user');
    Route::post('Offer_job', 'JobController@Offer_job');
    Route::post('post_to_complete', 'JobController@post_to_complete');
    Route::post('start_contract', 'JobController@start_contract');
    Route::post('decline_propsals', 'JobController@decline_propsals');
    Route::post('update/proposal/{job_id?}', 'JobController@update_proposal');
    Route::resource('portfolios', 'PortfolioController');

    Route::post('/save-cl-feedback', 'FeedbackController@save_fr_feedback');
    Route::post('/pay/freelancer/payfort/{job_id?}', 'PayfortController@returnRedirectUrl');
    Route::post('/pay/freelancer/success', 'PayfortController@returnResponsePayfort');
    Route::any('serach/freelancer/{type?}', 'ClientController@search_freelancer');

});

Route::group(['middleware' => ['freelancer_auth']], function () {
    Route::get('fr/notification','MessageController@getallNotification');
    Route::post('/fr_request/hours/post','PayfortController@post_fr_request_hours');
    Route::post('fr/get_clMessages','MessageController@get_clMessages');
    Route::post('fr/bank_info_update','DashboardController@update_fr_bank_info');
    Route::post('fr/payment/request','PayfortController@payment_request');
    Route::post('fr/fr_sendMessage','MessageController@fr_sendMessage');
    Route::post('/fr/get_clnewMessages','MessageController@clnewMessages');
    Route::post('/update/calender', 'ProfileController@update_calender');
    Route::get('fr/getConversation','MessageController@getfrConversation');
    Route::post('/add/calender', 'ProfileController@add_calender');
    Route::post('/delete/calender', 'ProfileController@delete_event');
    Route::post('/update/online_status','ProfileController@update_online_status');
    Route::post('/profileupdateImage', 'ProfileController@profileupdateImage');
    Route::post('portfolio/update/{portfolio_id}', 'ProfileController@updateportfolio');
    Route::post('/save/job', 'FindworkController@save_job');
    Route::post('createproposal', 'FindworkController@createproposal');
    Route::post('/accept_offer', 'JobController@accept_offer');
    Route::post('accept_for_interview', 'JobController@accept_for_interview');
    Route::post('/save-fr-feedback', 'FeedbackController@save_fr_feedback');
    Route::get('fr_mark/complete/job/{job_id}','JobController@fr_mark_complete');
    Route::post('fr_feedback/fr/submit','FeedbackController@save_fr_feedback');
});

Route::post('/profileupdate/{id}', 'ProfileController@update')->name('profileupdate');
Route::post('send/message', 'MessageController@Apisendmessage');
Route::post('single/message', 'MessageController@Apisinglemessage');
Route::post('send/freelancer/message', 'MessageController@sendfreelancermessage');
Route::any('/retrive/new/message', 'MessageController@Apinewmessage');
Route::post('/delete_notify', 'MessageController@delete_notify');

Route::post('/categories/add', 'CategoryController@store');

// Localization
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
       Route::get('/','HomeController@welcome');

        Route::get('/question', function () {
            return view('question');
        });
       

        Route::get('/MoreSkills','HomeController@moreSkills');
        Route::get('/team','TeamController@team');
        //contact_us
        Route::get('/contact_us', function () {
            return view('contact');
        });
        //Login
        Route::get('login', 'Auth\LoginController@getLogin');
        Route::get('logout', 'Auth\LoginController@getLogout');
        //Signup
        Route::get('register', 'Auth\RegisterController@getRegisterForm');
        Route::get('terms', 'Auth\RegisterController@terms');
        Route::get('activate/account/{token?}', 'Auth\RegisterController@activate_account');

        Route::get('register-freelancer', 'Auth\RegisterController@getRegisterForm');
        Route::get('forget/password', 'Auth\LoginController@forget_password');

        Route::get('/reset/password/{reset_token?}', 'Auth\LoginController@reset_password');

        Route::group(['middleware' => ['admin_auth']], function () {
            Route::get('manage/team','TeamController@index');
            Route::get('add_member','TeamController@add_member_form');
            Route::get('edit/{id}/team','TeamController@edit_member_form');
            Route::get('del/{id}/member','TeamController@del_member');
            Route::get('manage/portfolio','AdminPortfolioController@index');
            Route::get('add_portfolio','AdminPortfolioController@add_portfolio_form');
            Route::get('del/{id}/portfolio','AdminPortfolioController@del_portfolio');
            Route::get('edit/{id}/portfolio','AdminPortfolioController@edit_portfolio_form');

            Route::get('add/fr/skills/{category_id}','CategoryController@add_skill_form');
            Route::get('edit/fr/skills/{category_id}','CategoryController@edit_skill_form');
            Route::get('view/fr/skills/{category_id}','CategoryController@view_skills');
            Route::get('amount/tranfer/to_fr/{req_id}','PayfortController@amount_tr_fr');
            Route::get('withdraw/requests','PayfortController@fr_withdraw_requests');
            Route::get('withdraw/money','PayfortController@fr_withdraw_money');
            Route::get('aprove_claim/{r_id}/{hire_id}','JobController@approve_claim');
            Route::get('reject_claim/{r_id}/{hire_id}','JobController@reject_claim');
            Route::any('detail/allUsers','DashboardController@allUsersDetails');
            Route::get('jobs/claimjobs','JobController@claimJobsList');
            Route::get('jobs/invoices','JobController@completeJobInvoices');
            Route::get('dashboard', 'DashboardController@index');
            Route::resource('categories', 'CategoryController');
            
            Route::resource('profetionls', 'ProfetionalSkills');
            Route::get('manage/client', 'DashboardController@manage_client');
            Route::get('manage/freelancer', 'DashboardController@manage_freelancer');
            Route::get('report/abuse/freelancer', 'DashboardController@report_abuse_freelancer');
            Route::get('manage/terms', 'DashboardController@manage_terms');
            Route::get('save/terms', 'DashboardController@save_terms');
            Route::get('update/option', 'DashboardController@update_option_view');
            Route::get('suspend/user/{user_id?}', 'DashboardController@suspend_user');
            Route::get('activate/suspend/user/{user_id?}', 'DashboardController@activate_suspend_user');
            Route::get('/approve/user/{user_id?}', 'DashboardController@approve_user');
            Route::get('/verify/user/{user_id?}', 'DashboardController@verify_user');
            Route::get('/unverify/user/{user_id?}', 'DashboardController@unverify_user');
             Route::get('/qouts', 'DashboardController@manage_qouts_form');
             Route::get('/manage_qouts', 'DashboardController@manage_qouts');
            Route::get('/del/{id}/qouts', 'DashboardController@destroy_qouts');
            Route::get('/edit/{id}/qouts', 'DashboardController@edit_qouts_form');
            Route::get('/manage_skills', 'DashboardController@manage_skills');
            Route::get('/add_skills', 'DashboardController@manage_skills_form');
            Route::get('/view/{id}/manage_subSkills', 'DashboardController@manage_sub_skills');
            Route::get('/del/{id}/skills', 'DashboardController@destroy_skill');
            Route::get('/del/{id}/sub_skills', 'DashboardController@destroy_sub_skill');
            Route::get('/edit/{id}/skill', 'DashboardController@edit_skill_form');
            Route::get('/add_sub_skills/{id}', 'DashboardController@manage_sub_skills_form');
            Route::get('/aprove_freelancer/{id}', 'DashboardController@aprove_freelancer');
            Route::get('/reject_freelancer/{id}', 'DashboardController@reject_freelancer');
           Route::any('testmail','HomeController@testmail');
//            Route::get('joblist', 'JobController@joblisting');
            Route::any('/jobListing','DashboardController@jobListing');
            Route::get('/SuccessJobListing','DashboardController@SuccessJobListing');
            Route::any('/faildJobs','DashboardController@faildJobs');
        });
        Route::group(['middleware' => ['All']], function () {
            Route::get('download/receipent/{id}/{type?}','PayfortController@download_receipent');
            Route::get('job/proposal/{key?}', 'FindworkController@job_proposal');
            Route::get('user/detail/{user_id}','DashboardController@userDetail');
        });
        Route::group(['middleware' => ['client_auth']], function () {

            Route::get('cl/active_jobs','JobController@cl_active_jobs');
            Route::get('cl/hours/req','JobController@hours_requests');
            Route::get('cl_completed/jobs','JobController@cl_completed_jobs');
            Route::get('view/fr_profile/{fr_id}','ProfileController@view_fr_profile');
            Route::get('cl/dashboard', 'ProfileController@cl_dashboard');
            Route::get('cl/profile', 'ProfileController@cl_profile');
            Route::any('find/freelancer/{type?}', 'ClientController@index');
            Route::get('reload/freelancer/', 'ClientController@reloadData');
            Route::get('report/freelancer/', 'ClientController@report_freelancer');
            Route::get('create/jobpost/{job_type?}/{job_id?}', 'JobController@jobpost');
            Route::get('jobpost/{id}/edit', 'JobController@editjobpost');
            Route::get('joblist', 'JobController@joblisting');
            Route::get('clmy/job/{job_id?}', 'JobController@clmy_listing');
            Route::get('clmy-job', 'JobController@clmylisting');
            Route::get('postjob/to/invite/{user_id?}', 'JobController@invite_user_for_job');
            Route::get('view/proposal/{job_id?}', 'JobController@view_proposal');
            Route::get('edit/proposal/{job_id?}', 'JobController@edit_proposal');
            Route::get('clmessages', 'MessageController@Apiclgetmessage');
            Route::resource('portfolios', 'PortfolioController');
            Route::get('give/cl/feedback/{job_id}', 'FeedbackController@clfeedback');
            Route::get('/verifyCheckout/{proposal_id?}/{user_id?}', 'PayfortController@verifyCheckout');
            Route::get('/payfort/success/{payfort_id?}', 'PayfortController@payfortSuccess');
            Route::get('/payfort/cancel/{payfort_id?}', 'PayfortController@payfortCancel');

        });

        Route::group(['middleware' => ['freelancer_auth']], function () {
            Route::get('fr/dashboard', 'ProfileController@fr_dashboard');
            Route::get('fr/profile', 'ProfileController@fr_profile');
            Route::get('fr/bank_info','DashboardController@fr_bank_info');
            Route::get('fr_earning/report','ReportsController@fr_report');
            Route::get('fr/request/hours/{job_id}','PayfortController@fr_request_hours');
            Route::get('fr/withDrawRequest','PayfortController@withDrawRequest');
            Route::get('educationedit', 'ProfileController@updateEducation');
            Route::get('find/work', 'FindworkController@index');
            Route::get('find/search', 'FindworkController@get_search');
            Route::get('fr/view/proposal/{key?}', 'FindworkController@fr_view_proposal');
            Route::get('submit/proposal/{key?}/{proposal_id?}', 'FindworkController@proposal');
            Route::get('proposals', 'ProposalsController@index');
            Route::get('reject-proposal/{proposal_id?}', 'ProposalsController@reject');
            Route::get('saved/job', 'ProposalsController@save_job');
            Route::get('my/job', 'ProposalsController@my_completed_job');
            Route::get('my/contract', 'ProposalsController@my_contract_job');

            Route::get('earning-by-client', 'ReportsController@earning_by_client');
            Route::get('lifetime-billing', 'ReportsController@lifetime_billing');
            Route::get('transaction-history', 'ReportsController@transaction_history');

            Route::get('/earning/download_csv/{from_date?}/{to_date?}', 'ReportsController@earning_csv');
            Route::get('/transaction/download_csv/{from_date?}/{to_date?}', 'ReportsController@transaction_csv');

            Route::get('/create_invite/{proposal_id?}', 'ProposalsController@create_invite');
            Route::get('frmessages', 'MessageController@Apifrgetmessage');
            Route::get('give/fr/feedback/{job_id}', 'FeedbackController@index');
            Route::get('edit/fr/profile', 'ProfileController@edit_fr_profile');
            Route::get('edit/fr/profile2', 'ProfileController@edit_fr_profile2');

            Route::get('fr_earning/by_client','ReportsController@fr_earning');
        });

        Route::get('edit/cl/profile', 'ProfileController@edit_cl_profile');

        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/skills', 'HomeController@home_skills');
    }
);
