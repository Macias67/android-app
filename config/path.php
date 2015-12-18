<?php

return [
	'clientes' => 'src',
	'temporal' => 'tmp',
	'storage'  => ($app->environment('local')) ? 'http://android.app/' : 'http://test-storage-app.storage.googleapis.com/'
];