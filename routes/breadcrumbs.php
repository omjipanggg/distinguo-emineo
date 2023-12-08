<?php
use App\Models\Tokeniser;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home.index', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home.index'));
});

// Home > Evaluator
Breadcrumbs::for('evaluator.lounge', function (BreadcrumbTrail $trail, Tokeniser $token) {
    $trail->parent('home.index');
    $trail->push($token->token, route('evaluator.lounge', $token));
});

// Dashboard
Breadcrumbs::for('evaluation.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('evaluation.index'));
});

// Dashboard > Score
Breadcrumbs::for('evaluation.score', function (BreadcrumbTrail $trail) {
    $trail->parent('evaluation.index');
    $trail->push('Penilaian: Data', route('evaluation.score'));
});

// Dashboard
Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// Home > Tokeniser
Breadcrumbs::for('token.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Penilai', route('token.index'));
});

// Dashboard > Assessment
Breadcrumbs::for('assessment.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Asesmen', route('assessment.index'));
});

// Dashboard > Criteria
Breadcrumbs::for('criteria.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Kriteria', route('criteria.index'));
});

// Home > User
Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Pengguna', route('user.index'));
});

// Home > Out Source
Breadcrumbs::for('member.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Peserta', route('member.index'));
});

// Dashboard > History
Breadcrumbs::for('evaluation.history', function (BreadcrumbTrail $trail) {
    $trail->parent('evaluation.index');
    $trail->push('Penilaian: Riwayat', route('evaluation.history'));
});

// Home > Blog > [Category]
/*
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});
*/
