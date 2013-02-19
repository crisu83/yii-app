<?php

return CMap::mergeArray(
	require(__DIR__ . '/web.php'),
	// production environment configuration
	array(
	)
);