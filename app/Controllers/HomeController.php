<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\User;

class HomeController extends BaseController
{
    public function index(): string|\PHPFrw\View
    {
        $lastWorks = db()->query("select * from works order by id desc limit 3")->get();
        return view('home', [
            'title'=>' :: Главная',
            'menu' => $this->renderMenu(),
            'lastWorks' => $lastWorks
        ]);
    }

    public function works(): string | \PHPFrw\View{
        $categories = db()->query("select * from categories")->get();
        return view('works',[
            'title'=>' :: Готовые работы',
            'menu' => $this->renderMenu(),
            'categories' => $categories
        ]);
    }

    public function contacts(): string|\PHPFrw\View
    {
        return view('contacts', [
            'title'=>' :: Контакты',
            'menu' => $this->renderMenu()
        ]);
    }

    public function law(): string|\PHPFrw\View
    {
        return view('law', [
            'title' => ' :: Закон',
            'menu' => $this->renderMenu()
        ]);
    }

    public function service(): string|\PHPFrw\View
    {
        return view('service', [
            'title' => ' :: Дополнительные услуги',
            'menu' => $this->renderMenu()
        ]);
    }

    public function procedure(): string|\PHPFrw\View
    {
        return view('procedure', [
            'menu' => $this->renderMenu(),
            'info' => $this->renderProcedure()
        ]);
    }

    public function priceService(): string|\PHPFrw\View
    {
        return view('priceService', [
            'title' => ' :: Стоимость',
            'menu' => $this->renderMenu()
        ]);
    }

    public function priceCalculate()
    {
        $model = new Order();
        $model->loadData();

        if (request()->isAjax()){

            if (!$model->validate()){
                echo json_encode([
                    'status' => 'error',
                    'data' => $model->listErrors()
                ]);
                die;
            }
            if ($model->save()){
                echo json_encode([
                    'status' => 'success',
                    'data' => 'мы приняли вашу заявку',
                    'redirect' => base_url('/')
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'data' => 'something wrong in DB'
                ]);
            }
            die;
        }
    }

    public function ajaxRequest()
    {
        if (request()->isAjax()) {
            echo json_encode([
                'status' => 'success',
                'page_step' => $this->renderProcedure()
            ]);
            die;
        }
        echo 'ошибка в ajaxRequest()';die;
    }

    public function dashboard()
    {
        return view('dashboard', [
            'title'=>'dashboard'
        ]);
    }

    public function contact()
    {
        return "contact page";
    }
}