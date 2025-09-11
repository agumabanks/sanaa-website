<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('renders finance landing', function () {
    $this->get('/finance')->assertOk();
});

it('renders pricing and cards pages', function () {
    $this->get(route('finance.pricing'))->assertOk();
    $this->get(route('finance.cards'))->assertOk();
});

it('renders contact sales form', function () {
    $this->get(route('finance.contact-sales'))->assertOk();
});
