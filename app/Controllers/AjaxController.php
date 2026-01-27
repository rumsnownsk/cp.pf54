<?php


namespace App\Controllers;

use PHPFrw\Pagination;

class AjaxController extends BaseController
{
    //TODO чтобы не запрашивать Все работы при любой странице сайта
    public function allWorks()
    {
        $where = "";
        $limit = "limit 9";
        $catId = request()->get('catId');
        $countClick = '';

        if (request()->get('countClick')){
            $countClick = request()->get('countClick');
            $startIndex = $countClick * 9;
            $limit = "limit $startIndex, 9";
        }

        if (!empty($catId)){
            $where = "where category_id = {$catId} and publish = 1";
        };

        $works = db()
            ->query("select `id`,`title`,`photoName`,`timeCreate`,`category_id`
                            from works
                            {$where}
                            order by timeCreate                        
                            DESC
                            {$limit}")
            ->get();
        foreach ($works as $k => $v) {
            $works[$k]['timeCreate'] = $this->date_ru($v['timeCreate']);
        }

        if (request()->isAjax()) {
            echo json_encode([
                'message' => $where,
                'status' => 'success',
                'worksPage' => $this->renderWorksByCategoryId($works),
                'countClick' => $countClick,
                'catId' => request()->get('catId')
            ]);
            die;
        }
        echo 'ошибка в worksByCategoryId()';die;
    }

    public function loadMore()
    {
        $where = "";
        $limit = "limit 9";
        $catId = request()->get('catId');
        $countClick = '';

        if (request()->get('countClick')){
            $countClick = request()->get('countClick');
            $startIndex = $countClick * 9;
            $limit = "limit $startIndex, 9";
        }

        if (!empty($catId)){
            $where .= "where category_id = {$catId} and publish = 1";
        };

        $works = db()
            ->query("select `id`,`title`,`photoName`,`timeCreate`,`category_id`
                            from works
                            {$where}
                            order by timeCreate                        
                            DESC
                            {$limit}")
            ->get();
        foreach ($works as $k => $v) {
            $works[$k]['timeCreate'] = $this->date_ru($v['timeCreate']);
        }

        empty($works) ? $status = false : $status = true;

        if (request()->isAjax()) {
            echo json_encode([
                'message' => $where,
                'status' => $status,
                'worksPage' => $this->renderWorksByCategoryId($works),
                'countClick' => $countClick,
                'catId' => request()->get('catId')
            ]);
            die;
        }
        echo 'ошибка в worksByCategoryId()';die;
    }

    public function worksByCategoryId()
    {
        $where = "";
        $limit = "limit 9";
        $catId = request()->get('catId');
        $countClick = '';

        if (request()->get('countClick')){
            $countClick = request()->get('countClick');
            $startIndex = $countClick * 9;
            $limit = "limit $startIndex, 9";
        }

        if (!empty($catId)){
            $where = "where category_id =  {$catId} and publish = 1";
        };

        $works = db()
            ->query("select `id`,`title`,`photoName`,`timeCreate`,`category_id`
                            from works
                            {$where}
                            order by timeCreate                        
                            DESC
                            {$limit}")
            ->get();
        foreach ($works as $k => $v) {
            $works[$k]['timeCreate'] = $this->date_ru($v['timeCreate']);
        }

        if (request()->isAjax()) {
            echo json_encode([
                'message' => $where,
                'status' => 'success',
                'worksPage' => $this->renderWorksByCategoryId($works),
                'countClick' => $countClick,
                'catId' => request()->get('catId')
            ]);
            die;
        }
        echo 'ошибка в worksByCategoryId()';die;
    }


    public function tBodyWorks()
    {
        $countWorks = db()->getCount('works');
        $pagination = new Pagination($countWorks);

        $data = request()->getData();
        $strSearch = isset($data['strSearch']) ? " where works.title like '%".$data['strSearch']."%' " : false;


        $pagePag = isset($data['pagePag']) ?? false;

        $slice = $strSearch
            ? ''
            : "limit {$pagination->perPage()} offset {$pagination->getOffset()}";

//        join publish on works.publish=publish.publish_id
//        publish.title as publish,

        $works = db()->query("
            select works.id, works.title, works.photoName, works.publish, works.timeCreate,
                   categories.title as category
            from works
            join categories on works.category_id=categories.id
            {$strSearch}
            order by works.id DESC
            {$slice}
            ")->get();

        foreach ($works as $k => $v) {
            $works[$k]['timeCreate'] = $this->date_ru($v['timeCreate']);
            $works[$k]['publish'] = (int)$works[$k]['publish'] === 1
                ? "<i class='fas fa-check fa-2x' style='color: #537917;'></i>"
                : "<i class='fas fa-ban' style='color: #FF0000;'></i>";
        }

        echo json_encode([
            'countWorks' => db()->getCount('works'),
            'pagination' => $strSearch ? '' : $pagination->getHtml(),
            'tBody' => view()->renderPartial("incs/tBodyWorks", [
                'works' => $works
            ]),
            'strSearch' => $data['strSearch'] ?? '',
            'pagePag' => $data['pagePag'] ?? null
        ]);
        die;
    }
}