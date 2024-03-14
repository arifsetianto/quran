<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';

// Config

set('bin/php', function () {
    return '/usr/local/bin/php';
});

set('application', 'ThaiQuran');
set('repository', 'https://github.com/arifsetianto/quran.git');

set('git_tty', true);
set('git_ssh_command', 'ssh -o StrictHostKeyChecking=no');

set('keep_releases', 5);

set('writable_mode', 'chmod');

add('shared_files', ['.env']);
add('shared_dirs', ['storage']);
add('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/framework',
    'storage/logs',
]);

set('composer_options', '--verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');

// Hosts

host('thaiquran')
->setHostname('159.65.139.93')
->set('remote_user', 'root')
->set('port', 22)
->set('branch', 'main')
->set('deploy_path', '/var/www/thaiquran');

// Hooks

task('deploy:secrets', function () {
    file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path') . '/shared');
});

desc('Build assets');
task('deploy:build', [
    'npm:install',
]);

task('deploy', [
    'deploy:prepare',
    'deploy:secrets',
    'deploy:vendors',
    'deploy:shared',
    'artisan:storage:link',
    //'artisan:queue:restart',
    'deploy:publish',
    'deploy:unlock',
]);

after('deploy:failed', 'deploy:unlock');
before('deploy:symlink', 'artisan:migrate');
