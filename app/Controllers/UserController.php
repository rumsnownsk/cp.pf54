<?php
namespace App\Controllers;

use App\Models\User;
use JetBrains\PhpStorm\NoReturn;
use PHPFrw\Auth;
use PHPFrw\Pagination;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->changeLayout("authLayout");
    }


//    public function index()
//    {
//        $users_cnt = db()->query("select count(*) from users")->getColumn();
//
//        $limit = PAGINATION_SETTINGS['perPage'];
//        $pagination = new Pagination($users_cnt);
//        $users = db()->query("select * from users limit $limit offset {$pagination->getOffset()}")->get();
//
//        return view('user/index', [
//            'title' => 'all users',
//            'users' => $users,
//            'pagination' => $pagination,
//            'menu' => $this->renderMenu()
//        ]);
//    }

//    public function register()
//    {
//        return view('user/register', [
//            'title' => 'register page',
//        ]);
//    }

    public function login(): string|\PHPFrw\View
    {
//        $credential = [
//            'name'=> 'admin1',
//            'password'=>'admin1'
//        ];
//        $password = $credential['password'];
//        unset($credential['password']);
//        $field = array_key_first($credential);
//        $value = $credential[$field];
//
//        $user = db()->findOne('users', $value, $field);
//        dump($user);
        return view('user/login', [
            'title' => 'Авторизация',
        ]);
    }

    #[NoReturn] public function auth(): void
    {
        $model = new User();
        $model->loadData();

        if (!$model->validate($model->attributes, [
            'required'=>['email', 'password']
        ])){
            echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
            die;
        }
//        session();
        if (Auth::login([
            'email'=>$model->attributes['email'],
            'password'=>$model->attributes['password']
        ])){
            echo json_encode(['status' => 'success', 'data' => 'success login', 'redirect' => base_url('/')]);
        } else {
            echo json_encode(['status' => 'error', 'data' => "Ошибка email или password. Или аккаунт не одобрен"]);
        }
        die;
    }

//    public function store()
//    {
//        $model = new User();
//        $model->loadData();
//
//        if (request()->isAjax()) {
//            if (!$model->validate()) {
//                echo json_encode(['status' => 'error', 'data' => $model->listErrors()]);
//                die;
//            }
//
//            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);
//            if ($id = $model->save()) {
//                echo json_encode([
//                    'status' => 'success',
//                    'data' => 'Thanks for registration. Your ID: ' . $id,
//                    'redirect' => base_url('/login')]);
//            } else {
//                echo json_encode(['status' => 'error', 'data' => 'Error registration']);
//            }
//            die;
//        }
//
////        if (!$model->validate()) {
////            session()->setFlash('error', 'Validation errors');
////            session()->set('form_errors', $model->getErrors());
////            session()->set('form_data', $model->attributes);
////        } else {
////            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);
////            if ($id = $model->save()) {
////                session()->setFlash('success', 'Thanks for registration. Your ID: ' . $id);
////            } else {
////                session()->setFlash('error', 'Error registration');
////            }
////
////        }
//        response()->redirect('/register');
//    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        response()->redirect(base_url('/'));
    }
}