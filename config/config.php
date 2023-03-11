<?php

/*
|--------------------------------------------------------------------------
| Relesys API OAuth2 credentials
|--------------------------------------------------------------------------
|
| The API uses a OAuth2 token (Bearer token) for authentication.
| To get one, we must first make an HTTP call to our token endpoint,
| with the credentials provided by Relesys prior to this.
|
*/
return [
    'relesys_client_id'     => env('RELESYS_CLIENT_ID'),
    'relesys_client_secret' => env('RELESYS_CLIENT_SECRET'),
];
