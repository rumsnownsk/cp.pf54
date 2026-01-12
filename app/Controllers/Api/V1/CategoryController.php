<?php

namespace App\Controllers\Api\V1;

class CategoryController{

    public function index(){
        $categories = db()->findAll('categories');
        response()->json(['status'=>200, 'data'=>$categories]);
    }

    public function view(){
        $slug = get_route_param('slug');
//        var_dump($slug);exit();
        $category = db()->findOrFail('categories', $slug,'slug');
        response()->json(['status'=>200, 'data'=>$category]);
    }
}
