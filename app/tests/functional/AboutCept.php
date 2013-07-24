<?php
$I = new TestGuy($scenario);
$I->wantTo('ensure that about works');
$I->amOnPage('?r=site/page&view=about');
$I->see('About', 'h1');
