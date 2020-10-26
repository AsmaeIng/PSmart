<?php

namespace App\Http\Controllers;

class ExtraComponentsController extends Controller
{
    public function rangeSlider()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "Range Slider"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.extra-components-range-slider', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function sweetAlert()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "Sweetalert"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.extra-components-sweetalert', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function nestAble()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "Nestable"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.extra-components-nestable', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function treeView()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "Treeview"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.extra-components-treeview', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function ratings()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "Ratings"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.extra-components-ratings', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function tour()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "Tour"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.extra-components-tour', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function i18n()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "i18n"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.extra-components-i18n', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function highlight()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extra Components"], ['name' => "Highlight"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.extra-components-highlight', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
}
