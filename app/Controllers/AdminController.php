<?php

namespace App\Controllers;

use App\Models\Work;
use PHPFrw\Auth;
use PHPFrw\File;
use PHPFrw\Pagination;

class AdminController extends BaseController
{
    public function __construct()
    {
//        if (!Auth::isAuth()) {
//            session()->setFlash('error', 'нужно зарегаться');
//            response()->redirect(base_url('/'));
//        } else if (Auth::isAuth() && Auth::getRole() == 0) {
//            session()->setFlash('error', 'Доступ для вас закрыт');
//            session()->remove('user');
//            response()->redirect(base_url('/'));
//        }
        $this->changeLayout('adminLayout');
    }


    public function index(): string
    {
        return view('main');
    }

    public function create()
    {
        if (request()->isGet()){
            return view('create',[
                'categories'=> db()->query("select * from categories")->get()
            ]);
        }

        $file = new File();

        $work = new Work();
        $work->loadData();
        $work->attributes['timeCreate'] = strtotime($work->attributes['timeCreate']);
        $work->attributes['publish'] = $work->attributes['publish'] ? 1 : 0;
        if(request()->isFileUploaded()){
            $work->attributes['photoName'] = $file->imageNameDb;
        }
        if ($work->save()){
            $file->save();
        };

        response()->redirect('/');
    }

    public function build()
    {
        $id = get_route_param('id');
        $work = db()->findOrFail('works', $id);
        $categories = db()->query("select * from categories")->get();

        return view('build', [
            'work' => $work,
            'categories' => $categories
        ]);
    }

    public function store(){
        $id = get_route_param('id');

        $work = new Work();
        $work->loadData();

        $work->attributes['timeCreate'] = strtotime($work->attributes['timeCreate']);
        $work->attributes['publish'] = $work->attributes['publish'] ? 1 : 0;

        if(request()->isFileUploaded()){
            $oldFileName = db()->query("select photoName from works where id = $id")->getOne();

            File::remove(IMAGES.'/works', $oldFileName['photoName']);
            $file = new File();
            $work->attributes['photoName'] = $file->imageNameDb;
            $file->save();
        };
        $work->update('works', $id);

        response()->redirect(base_url('/build/'.$id));
    }

    public function remove(): void
    {
        $id = get_route_param('id');
        if ($work = db()->findOrFail('works', $id)){
            File::remove(IMAGES.'/works', $work['photoName']);
            db()->query("delete from works where id = {$id}");
        };
        response()->redirect('/');
    }

    public function resetId(){
        db()->query("ALTER TABLE works AUTO_INCREMENT = 1");
        db()->query('SET @i=0; UPDATE works SET id=(@i:=@i+1)');
        session()->setFlash('success', 'AUTO_INCREMENT has been reset');
        response()->redirect('/');
    }
}