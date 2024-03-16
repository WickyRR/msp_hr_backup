 <?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecruitController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\PillarController;

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

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware(['auth','allowAccess:route_home']);
Route::get('/apply', 'App\Http\Controllers\ApplicantsController@index')->name('apply');
Route::post('/apply', ['as' => 'apply.store', 'uses' => 'App\Http\Controllers\ApplicantsController@store']);
Route::get('/apply/success', ['as' => 'apply.success', 'uses' => 'App\Http\Controllers\ApplicantsController@success']);
Route::post('/fetch/departments', 'App\Http\Controllers\FacultyController@fetchdep');
Route::get('/memberForm','App\Http\Controllers\MemberFormController@memberCollection');
Route::post('/saveMember',  'App\Http\Controllers\MemberFormController@store');
Route::get('/saveMember/success', ['as' => 'saveMember.success', 'uses' => 'App\Http\Controllers\MemberFormController@success']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
    //Route::get('applicants', ['as' => 'pages.members', 'uses' => 'App\Http\Controllers\PageController@getAllUser']);
    Route::get('applicants', ['as' => 'pages.members', 'uses' => 'App\Http\Controllers\ApplicantsController@view']);
    Route::get('/delete/{id}', ['as' => 'pages.members.delete', 'uses' => 'App\Http\Controllers\ApplicantsController@delete']);
    Route::post('/applicant/get', ['as' => 'applicant.get', 'uses' => 'App\Http\Controllers\RecruitController@getById']);
    Route::post('/applicant/update', ['as' => 'applicant.update', 'uses' => 'App\Http\Controllers\RecruitController@updatenow']);
    Route::delete('delete-all', [RecruitController::class, 'deletechecked'])->name('users.multiple-delete');
    Route::post('/applicant/filter', ['as' => 'applicant.filter', 'uses' => 'App\Http\Controllers\ApplicantsController@filter']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('/applicants/cv/download/{id}', ['as' => 'filedownload.cv', 'uses' => 'App\Http\Controllers\FileDownloadController@downloadCV']);
    Route::get('/applicants/{process_id}/download', ['as' => 'applicants.download.all', 'uses' => 'App\Http\Controllers\ApplicantsController@downloadCSV']);
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/recruitment/add', ['as' => 'recruitment.add', 'uses' => 'App\Http\Controllers\RecruitmentController@add']);

    Route::post('/recruitment/add', ['as' => 'recruitment.save', 'uses' => 'App\Http\Controllers\RecruitmentController@store']);

    Route::get('/recruitment/view', ['as' => 'recruitment.view', 'uses' => 'App\Http\Controllers\RecruitmentController@view']);


    Route::post('/recruitment/get', ['as' => 'recruitment.get', 'uses' => 'App\Http\Controllers\RecruitmentController@getRecruitmentById']);
    Route::post('/recruitment/update', ['as' => 'recruitment.update', 'uses' => 'App\Http\Controllers\RecruitmentController@updateRecruitment']);
    Route::delete('/recruitment/delete', ['as' => 'recruitment.delete', 'uses' => 'App\Http\Controllers\RecruitmentController@deleteRecruitment']);
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/projects/add', ['as' => 'projects.add', 'uses' => 'App\Http\Controllers\ProjectController@add']);
    Route::post('/projects/add', ['as' => 'projects.save', 'uses' => 'App\Http\Controllers\ProjectController@store']);

    Route::get('/projects/view', ['as' => 'projects.view', 'uses' => 'App\Http\Controllers\ProjectController@view']);

    Route::post('/projects/get', ['as' => 'projects.get', 'uses' => 'App\Http\Controllers\ProjectController@getProjectById']);
    Route::post('/projects/update', ['as' => 'projects.update', 'uses' => 'App\Http\Controllers\ProjectController@updateProject']);
    Route::delete('/projects/delete', ['as' => 'projects.delete', 'uses' => 'App\Http\Controllers\ProjectController@deleteProject']);

    Route::get('/projects/roles', ['as' => 'projects.roles', 'uses' => 'App\Http\Controllers\ProjectController@projectRoles']);
    Route::post('/projects/rolesadd', ['as' => 'projects.rolesadd', 'uses' => 'App\Http\Controllers\ProjectController@projectRolesAdd']);
    Route::post('/projects/roleget', ['as' => 'projects.roleget', 'uses' => 'App\Http\Controllers\ProjectController@projectRolesGetByID']);
    Route::post('/projects/rolesedit', ['as' => 'projects.rolesedit', 'uses' => 'App\Http\Controllers\ProjectController@projectRoleUpdate']);
    Route::delete('/projects/deleterole', ['as' => 'projects.deleterole', 'uses' => 'App\Http\Controllers\ProjectController@deleteRole']);

    Route::post('/projects/pillarmemberget', ['as' => 'projects.pillarmemberget', 'uses' => 'App\Http\Controllers\ProjectController@getPillarMembersByID']);
    Route::post('/projects/crewget', ['as' => 'projects.crewget', 'uses' => 'App\Http\Controllers\ProjectController@projectCrewGetByID2']);
    Route::post('/projects/crewadd', ['as' => 'projects.crewadd', 'uses' => 'App\Http\Controllers\ProjectController@projectCrewAdd']);
    Route::delete('/projects/crewdelete', ['as' => 'projects.crewdelete', 'uses' => 'App\Http\Controllers\ProjectController@deleteCrewMember']);
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/finance/add', ['as' => 'finance.add', 'uses' => 'App\Http\Controllers\FinanceController@add']);
    Route::post('/finance/add', ['as' => 'finance.save', 'uses' => 'App\Http\Controllers\FinanceController@store']);
    Route::get('/finance/view', ['as' => 'finance.view', 'uses' => 'App\Http\Controllers\FinanceController@view']);
    Route::get('/finance/view', ['as' => 'finance.view', 'uses' => 'App\Http\Controllers\FinanceController@view']);
    Route::get('/approved/{id}', ['as' => 'finance.approved', 'uses' => 'App\Http\Controllers\FinanceController@approved']);
    Route::get('/reject/{id}', ['as' => 'finance.approved', 'uses' => 'App\Http\Controllers\FinanceController@reject']);
    Route::get('/reimburse/{id}', ['as' => 'finance.approved', 'uses' => 'App\Http\Controllers\FinanceController@reimburse']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/crew_member/add', ['as' => 'crewMember.add', 'uses' => 'App\Http\Controllers\CrewMemberController@add']);
    Route::post('/crew_member/add', ['as' => 'crewMember.save', 'uses' => 'App\Http\Controllers\CrewMemberController@store']);
    Route::post('/crew_member/get', ['as' => 'crewMember.get', 'uses' => 'App\Http\Controllers\CrewMemberController@get']);
    Route::get('/crew_member/view', ['as' => 'crewMember.view', 'uses' => 'App\Http\Controllers\CrewMemberController@view']);
});

Route::get('/mail-addresses/authenticate/{mail_id}', ['as' => 'mailAddresses.authenticate', 'uses' => 'App\Http\Controllers\MailAddressController@authenticateRoundCubeAndRedirect']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/pillar_members/webKpi/{param}', ['as' => 'webkpi.view', 'uses' => 'App\Http\Controllers\KPIsortController@getHighestKpiIdWeb']);
    Route::get('/pillar_members/hrKpi/{param}', ['as' => 'hrkpi.view', 'uses' => 'App\Http\Controllers\KPIsortController@getHighestKpiIdHr']);





    Route::get('moreDetails/{id}/{pillar}',[PillarController::class,'viewMoreDetails']);
    Route::get('/pillar_members/hrView', ['as' => 'hr.view', 'uses' => 'App\Http\Controllers\PillarController@viewHR']);
    Route::get('/pillar_members/designView', ['as' => 'design.view', 'uses' => 'App\Http\Controllers\PillarController@viewDesign']);
    Route::get('/pillar_members/newsView', ['as' => 'news.view', 'uses' => 'App\Http\Controllers\PillarController@viewNews']);
    Route::get('/pillar_members/markertingView', ['as' => 'markerting.view', 'uses' => 'App\Http\Controllers\PillarController@viewMarketing']);
    Route::get('/pillar_members/sProjectsView', ['as' => 'sProjects.view', 'uses' => 'App\Http\Controllers\PillarController@viewSproject']);
    Route::get('/pillar_members/cDevelopmentView', ['as' => 'cDevelopment.view', 'uses' => 'App\Http\Controllers\PillarController@viewCdevelopment']);
    Route::get('/pillar_members/editorialView', ['as' => 'editorial.view', 'uses' => 'App\Http\Controllers\PillarController@viewEditorial']);
    Route::get('/pillar_members/webView', ['as' => 'web.view', 'uses' => 'App\Http\Controllers\PillarController@viewWeb']);
    Route::get('/pillar_members/VEdittingView', ['as' => 'VEditting.view', 'uses' => 'App\Http\Controllers\PillarController@viewVEditing']);

    Route::get('/pillar_members/hrKpi', ['as' => 'hrkpi.view', 'uses' => 'App\Http\Controllers\KPIController@getHR']);
    Route::get('/pillar_members/designKpi', ['as' => 'designkpi.view', 'uses' => 'App\Http\Controllers\KPIController@getDesign']);
    Route::get('/pillar_members/newsKpi', ['as' => 'newskpi.view', 'uses' => 'App\Http\Controllers\KPIController@getNews']);
    Route::get('/pillar_members/marketingKpi', ['as' => 'marketingkpi.view', 'uses' => 'App\Http\Controllers\KPIController@getMarketing']);
    Route::get('/pillar_members/specialKpi', ['as' => 'specialkpi.view', 'uses' => 'App\Http\Controllers\KPIController@getSpecial']);
    Route::get('/pillar_members/coopKpi', ['as' => 'coopkpi.view', 'uses' => 'App\Http\Controllers\KPIController@getCoop']);
    Route::get('/pillar_members/editorialKpi', ['as' => 'editorialkpi.view', 'uses' => 'App\Http\Controllers\KPIController@getEditorial']);
    Route::get('/pillar_members/webKpi', ['as' => 'webkpi.view', 'uses' => 'App\Http\Controllers\KPIController@getWeb']);
    Route::get('/pillar_members/videoKpi', ['as' => 'videokpi.view', 'uses' => 'App\Http\Controllers\KPIController@getVideo']);

    Route::post('/pillar_members/hrKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdHr')->name('showMaxIdHr');
    Route::post('/pillar_members/hrKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdHr')->name('showMonthlyMaxIdHr');

    Route::post('/pillar_members/designKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdDesign')->name('showMaxIdDesign');
    Route::post('/pillar_members/designKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdDesign')->name('showMonthlyMaxIdDesign');

    Route::post('/pillar_members/newsKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdNews')->name('showMaxIdNews');
    Route::post('/pillar_members/newsKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdNews')->name('showMonthlyMaxIdNews');

    Route::post('/pillar_members/marketingKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdMarketing')->name('showMaxIdMarketing');
    Route::post('/pillar_members/marketingKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdMarketing')->name('showMonthlyMaxIdMarketing');

    Route::post('/pillar_members/specialKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdSpecial')->name('showMaxIdSpecial');
    Route::post('/pillar_members/specialKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdSpecial')->name('showMonthlyMaxIdSpecial');

    Route::post('/pillar_members/coopKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdCoop')->name('showMaxIdCoop');
    Route::post('/pillar_members/coopKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdCoop')->name('showMonthlyMaxIdCoop');

    Route::post('/pillar_members/editorialKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdEditorial')->name('showMaxIdEditorial');
    Route::post('/pillar_members/editorialKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdEditorial')->name('showMonthlyMaxIdEditorial');

    Route::post('/pillar_members/webKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdWeb')->name('showMaxIdWeb');
    Route::post('/pillar_members/webKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdWeb')->name('showMonthlyMaxIdWeb');

    Route::post('/pillar_members/videoKpiMax', 'App\Http\Controllers\KPIsortController@showMaxIdVideo')->name('showMaxIdVideo');
    Route::post('/pillar_members/videoKpiMonthlyMax/{month}', 'App\Http\Controllers\KPIsortController@showMonthlyMaxIdVideo')->name('showMonthlyMaxIdVideo');

    Route::post('/updateScores', ['as' => 'updatescores', 'uses' => 'App\Http\Controllers\KPIController@updateScores']);

});
