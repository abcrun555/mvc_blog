<?php

namespace application\lib;

class Pagination
{

    private  $posts_on_page = 10;
    //количество страниц
    private  $posts_total;
    //количество постов
    private  $pages_total;
    private  $current_page;
    private  $route;
    private  $links_on_page = 10;


    private function pagesTotal()
    {
        return ceil($this->posts_total / $this->links_on_page);
    }

    private function currentPage()
    {
        if (isset($this->route['page'])) {
            $this->current_page = $this->route['page'];
        } else {
            $this->current_page = 1;
        }
        if ($this->current_page > $this->pages_total) {
            $this->current_page = $this->pages_total;
        }
    }

    public function __construct($route, $posts_total)
    {
        $this->route = $route;
        $this->posts_total = $posts_total;
        $this->pages_total = $this->pagesTotal();
        $this->currentPage();
    }



    private function firstLastNumbers()
    {
        $left = $this->current_page - round($this->links_on_page / 2);
        $first_number = $left > 0 ? $left : 1;
        if ($first_number + $this->links_on_page <= $this->pages_total) {
            $last_number = $first_number > 1 ? $first_number + $this->links_on_page : $this->links_on_page;
        } else {
            $last_number = $this->pages_total;
            $first_number = $this->pages_total - $this->links_on_page > 0 ? $this->pages_total - $this->links_on_page : 1;
        }
        return array($first_number, $last_number);
    }

    private function linkGenerator($page, $text = NULL)
    {
        if (!$text) {
            $text = $page;
            return '<a class="page" href="/' . $this->route['controller'] . '/' . $this->route['action'] . '/' . $page . '">' . $text . '</a>';
        } else {
            return '<a class="edge_page" href="/' . $this->route['controller'] . '/' . $this->route['action'] . '/' . $page . '">' . $text . '</a>';
        }
    }

    public function getLinks()
    {

        $links = null;
        $first_last = $this->firstLastNumbers();
        $html = '<div class = "pagination">';
        for ($page = $first_last[0]; $page <= $first_last[1]; $page++) {
            if ($page == $this->current_page) {
                
                $links .= '<a class="current" ">' . $page . '</a>';
            } else {
                $links .= $this->linkGenerator($page);
            }
        }

        if ($this->current_page > 1) {
            $links = $this->linkGenerator(1, 'Вперед') . $links;
        }

        if ($this->current_page < $this->pages_total) {
            $links .= $this->linkGenerator($this->pages_total, 'Назад');
        }
        $html .= $links . '</div>';
        return $html;
    }
}
