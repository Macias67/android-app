<?php

return [
	'clientes' => 'src',
	'temporal' => 'tmp',
	//'storage'  => ($app->environment('local')) ? 'http://android.app/' : 'http://test-storage-app.storage.googleapis.com/'
        'storage'  => ($app->environment('local')) ? 'http://android.app/' : 'https://s3-us-west-1.amazonaws.com/my-androidapp/'
];