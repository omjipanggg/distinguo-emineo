<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AssessmentController as Assessment;
use App\Http\Controllers\CriteriaController as Criteria;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\EvaluationController as Evaluation;
use App\Http\Controllers\EvaluatorController as Evaluator;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\OutSourceController as OutSource;
use App\Http\Controllers\ProjectController as Project;
use App\Http\Controllers\ServerController as Server;
use App\Http\Controllers\TokenController as Token;
use App\Http\Controllers\UserController as User;

/* AUTH ===================================================================== */
Auth::routes(['verify' => true]);

/* HOME ===================================================================== */
Route::prefix('/')->group(function() {
	Route::get('/', [Home::class, 'index'])->name('home.index');
	Route::get('settings', [Home::class, 'settings'])->name('home.settings');
	Route::put('settings', [Home::class, 'saveConfiguration'])->name('home.saveConfiguration');
	Route::delete('vanish', [Home::class, 'vanish'])->name('home.vanish');
	Route::get('truncate/{table}', [Home::class, 'truncate'])->name('home.truncate');
});

/* DASHBOARD ===================================================================== */
Route::prefix('dashboard')->group(function() {
	Route::get('/', [Dashboard::class, 'index'])->name('dashboard.index');
	Route::get('config', [Dashboard::class, 'config'])->name('dashboard.config');
	Route::get('search', [Dashboard::class, 'search'])->name('dashboard.search');
});

/* TOKEN ===================================================================== */
Route::prefix('dashboard/token')->group(function() {
	Route::post('check', [Token::class, 'check'])->name('token.check');
});
Route::resource('dashboard/token', Token::class);

/* OUTSOURCE ===================================================================== */
Route::prefix('dashboard/member')->group(function() {
	Route::post('import', [OutSource::class, 'import'])->name('member.import');
});
Route::resource('dashboard/member', OutSource::class);

/* ASSESSMENT ===================================================================== */
Route::prefix('dashboard/assessment')->group(function() {
	Route::post('import', [Assessment::class, 'import'])->name('assessment.import');
});

Route::resource('dashboard/assessment', Assessment::class);

/* CRITERIA ===================================================================== */
Route::prefix('dashboard/criteria')->group(function() {
	Route::post('import', [Criteria::class, 'import'])->name('criteria.import');
});
Route::resource('dashboard/criteria', Criteria::class);

/* PROJECT ===================================================================== */
Route::prefix('dashboard/project')->group(function() {
	//
});
Route::resource('dashboard/project', Project::class);

/* USER ===================================================================== */
Route::prefix('dashboard/user')->group(function() {

});
Route::resource('dashboard/user', User::class);

/* EVALUATION ===================================================================== */
Route::prefix('evaluation')->group(function() {
	Route::get('history', [Evaluation::class, 'history'])->name('evaluation.history');
	Route::get('score', [Evaluation::class, 'score'])->name('evaluation.score');
	Route::get('temp', [Evaluation::class, 'temp'])->name('evaluation.temp');
});
Route::resource('evaluation', Evaluation::class);

/* EVALUATOR ===================================================================== */
Route::prefix('evaluator')->group(function() {
	Route::get('lounge', [Evaluator::class, 'lounge'])->name('evaluator.lounge');
});
Route::resource('evaluator', Evaluator::class);

/* SERVER ===================================================================== */
Route::prefix('server')->group(function() {
	Route::get('evaluator/store', [Server::class, 'storeEvaluator'])->name('server.storeEvaluator');
	Route::get('evaluator/update', [Server::class, 'updateEvaluator'])->name('server.updateEvaluator');

	Route::get('token/check', [Server::class, 'checkToken'])->name('server.checkToken');

	Route::get('fetch', [Server::class, 'fetch'])->name('server.fetch');
	Route::get('fetch/assessments', [Server::class, 'fetchAssessments'])->name('server.fetchAssessments');
	Route::get('fetch/criterias', [Server::class, 'fetchCriterias'])->name('server.fetchCriterias');
	Route::get('fetch/evaluations/history', [Server::class, 'fetchEvaluationHistory'])->name('server.fetchEvaluationHistory');
	Route::get('fetch/members', [Server::class, 'fetchMembers'])->name('server.fetchMembers');
	Route::get('fetch/scores', [Server::class, 'fetchScores'])->name('server.fetchScores');
	Route::get('fetch/tokens', [Server::class, 'fetchTokens'])->name('server.fetchTokens');
	Route::get('fetch/users', [Server::class, 'fetchUsers'])->name('server.fetchUsers');
	Route::get('fetch/{table}', [Server::class, 'fetchByTable'])->name('server.fetchByTable');
});