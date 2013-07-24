<?php
$I = new WebGuy($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage('');
$I->see('Application');
$I->seeLink('About');
$I->click('About');
$I->see('This is a "static" page.');
