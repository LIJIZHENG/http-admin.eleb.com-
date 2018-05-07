<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    //
    protected $fillable = [
        'menu_name', 'parents_id', 'menu_url','floor'
    ];

    //获取所有一级菜单
    public static function getMenus(){
        return self::where('parents_id',0)->get();
    }
    //获取子菜单
    public function children()
    {
        return $this->hasMany(self::class,'parents_id','id');
    }
    //菜单
    public static function nav()
    {
        $html = '';
        $navs = [];
        $menus = self::getMenus();
        foreach($menus as $menu){

            $items = [];
            foreach ($menu->children as $child){
                $items[] = $child;
            }
            if ($items){
                $navs[] = [
                    'name'=>$menu->menu_name,
                    'items'=>$items
                ];
            }
        }
        foreach ($navs as $nav){
            $html .= '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav['name'].' <span class="caret"></span></a>
                        <ul class="dropdown-menu">';
            foreach ($nav['items'] as $item){
//                dd($item->menu_name);
                $html .= '<li><a href="'.route($item->menu_url).'">'.$item->menu_name.'</a></li>';
            }
            $html .= '</ul></li>';
        }
        return $html;
    }

}
