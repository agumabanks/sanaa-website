<?php

use Symfony\Component\Process\Process;

uses(Tests\TestCase::class);

it('pages meet accessibility standards', function () {
    $server = Process::fromShellCommandline('php -S 127.0.0.1:8000 -t public');
    $server->start();
    sleep(2);

    $process = Process::fromShellCommandline('node tests/a11y.js http://127.0.0.1:8000', null, [
        'A11Y_THRESHOLD' => '95',
    ]);
    $process->run();

    $server->stop();

    expect($process->isSuccessful())->toBeTrue();
});
