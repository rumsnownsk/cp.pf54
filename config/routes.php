<?php

/** @var \PHPFrw\Application $app */

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\AjaxController;

const MIDDLEWARE = [
    'auth' => \PHPFrw\Middleware\Auth::class,
    'guest' => \PHPFrw\Middleware\Guest::class,
];

$app->router->get('/', [\App\Controllers\AdminController::class, 'index']);
$app->router->get('/resetId', [\App\Controllers\AdminController::class, 'resetId']);
$app->router->get("/build/create", [\App\Controllers\AdminController::class, 'create']);
$app->router->post("/build/create", [\App\Controllers\AdminController::class, 'create']);
$app->router->get("/build/(?P<id>[0-9]+)", [\App\Controllers\AdminController::class, 'build']);
$app->router->post("/build/(?P<id>[0-9]+)", [\App\Controllers\AdminController::class, 'store']);
$app->router->get("/build/(?P<id>[0-9]+)/remove", [\App\Controllers\AdminController::class, 'remove']);
$app->router->get("/test", function (){

});


$app->router->add('/api/v1/test', function (){
    response()->json([
        'status'=> 'success',
        'message'=>'good page'
    ]);
}, ['get', 'post', 'put'])->withoutCsrfToken();

$app->router->get('/api/v1/categories', [App\Controllers\Api\V1\CategoryController::class, 'index']);
$app->router->get('/api/v1/category/(?P<slug>[a-z0-9-]+)', [App\Controllers\Api\V1\CategoryController::class, 'view']);




$app->router->get('/allWorks', [AjaxController::class, 'allWorks']);
$app->router->get('/loadMore', [AjaxController::class, 'loadMore']);
$app->router->get('/worksByCategoryId', [AjaxController::class, 'worksByCategoryId']);
$app->router->post('/searchWorks', [AjaxController::class, 'searchWorks'])->withoutCsrfToken();
$app->router->get('/tBodyWorks', [AjaxController::class, 'tBodyWorks']);


//$app->router->get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth']);

//$app->router->get('/register', [UserController::class, 'register'])->middleware(['guest']);
//$app->router->post('/register', [UserController::class, 'store'])->middleware(['guest']);
$app->router->get('/login', [UserController::class, 'login'])->middleware(['guest']);
$app->router->post('/login', [UserController::class, 'auth'])->middleware(['guest']);
$app->router->get('/logout', [UserController::class, 'logout']);

//$app->router->get('/users', [UserController::class, 'index']);

$app->router->get('/work/(?P<id>[0-9]+)?', function (){
//    или $app->router->get('/post/(?P<id>[0-9-]+)/?', function (){
//    (?P) - означает, что это нужно запомнить то, что попадёт внутрь круглых скобок
//    <slug> - просто название переменной
//    [] - какие символы могут находиться в переменной slug
//    [a-z0-9-]  - от a до z, а также любые цифры
//    + означает, что должен быть хоть один символ
//    dump(app()->router->route_params['slug']);
    return '<p>Some post: </p>'.get_route_param('slug').get_route_param('id');
//    (мультиязычность, часть 1)
});


//$app->router->get('/clearImage', function (){
//    $y = 0;
//    $n = 0;
//    try {
//        $iterator = new RecursiveIteratorIterator(
//            new RecursiveDirectoryIterator(IMAGES.'/works/', RecursiveDirectoryIterator::SKIP_DOTS)
//        );
//
//        foreach ($iterator as $file) {
//            if ($file->isFile()) {
//                $fileName = $file->getFilename();
//
////                dump($fileName);
//                $res = db()->query("select * from works where photoName like CONCAT('%', :photoName)", ['photoName' => $fileName])->get();
//                if (!$res) {
//                    print_r("имя файла `$fileName` нету в таблице mysql.<br>");
//                    $n++;
//                    @unlink($file->getPathname());
//                } else {
//                    $y++;
//                    print_r("имя файла: `$fileName` есть в таблице mysql.<br>");
//                }
//            }
//        }
//        dump($y);
//        dd($n);
//    } catch (Exception $e) {
//        echo "Ошибка при чтении директории: " . $e->getMessage();
//    }
//});


