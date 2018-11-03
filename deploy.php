<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'store1');

// Project repository
set('repository', 'https://sunguide@bitbucket.org/sunguide/piustore.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('kabao.im')//,
    ->stage('test')
    ->user('root')
    ->set('deploy_path', '/home/wwwroot/nest.kabao.im');
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