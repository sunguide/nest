<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'nest');

// Project repository
set('repository', 'https://github.com/sunguide/nest.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('ohmynest.com')//,
    ->stage('dev')
    ->user('root')
    ->set('deploy_path', '/home/wwwroot/api.dev.ohmynest.com');

host('ohmynest.com')//,
->stage('test')
    ->user('root')
    ->set('deploy_path', '/home/wwwroot/api.test.ohmynest.com');

host('ohmynest.com')//,
    ->stage('production')
    ->user('root')
    ->set('deploy_path', '/home/wwwroot/api.ohmynest.com');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

task('restart', function(){
    run('service php-fpm restart');
});

after('cleanup', 'restart');

//command: