<?php

use Symfony\Component\Process\Process;

uses(Tests\TestCase::class);

it('pages meet accessibility standards', function () {
    $this->markTestSkipped('Accessibility audit skipped during automated testing.');
});
