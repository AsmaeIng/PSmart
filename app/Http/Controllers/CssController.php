<?php

namespace App\Http\Controllers;

class CssController extends Controller
{
    public function typographyCss()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Typography"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.css-typography', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function colorCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Color"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.css-color', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function gridCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Grid"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.css-grid', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function helpersCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Helpers"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.css-helpers', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function mediaCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Media"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.css-media', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function pulseCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Pulse"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.css-pulse', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function sassCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Sass"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.css-sass', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function shadowCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Shadow"],
        ];

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.css-shadow', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function animationCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Animations"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.css-animations', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function transitionCss()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "CSS"], ['name' => "Transitions"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.css-transitions', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
}
