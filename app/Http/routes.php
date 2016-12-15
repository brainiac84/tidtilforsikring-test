<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Library\BaseMapping;
use App\Library\Specialized1Mapping;
use App\Library\Specialized2Mapping;
use Illuminate\Http\Request;

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('/calculate/{type}', function (Request $request, $type) use ($app) {

    $input = $request->only(['A', 'B', 'C', 'D', 'E', 'F']);

    $mapping = null;

    switch ($type) {
        case 'specialized1':
            $mapping = new Specialized1Mapping($input);
            break;
        case 'specialized2':
            $mapping = new Specialized2Mapping($input);
            break;
        default:
            $mapping = new BaseMapping($input);
            break;
    }

    try {

        return response()->json($mapping->getResult());
    }
    catch (\LogicException $e)
    {
        return response()->json(['error' => $e->getMessage()]);
    }

});