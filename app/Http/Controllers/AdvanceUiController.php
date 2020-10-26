<?php

namespace App\Http\Controllers;

class AdvanceUiController extends Controller
{
    public function carouselUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Carousel"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-carousel', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function collapsibleUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Collapsibles"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-collapsibles', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function toastUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Toasts"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-toasts', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function tooltipUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Tooltip"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-tooltip', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function dropdownUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Dropdown"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-dropdown', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function discoveryFeature()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Feature Discovery"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        return view('pages.advance-ui-feature-discovery', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function mediaUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Media"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-media', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function modalUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Modals"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-modals', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function scrollspyUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Scrollspy"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-scrollspy', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function tabsUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Tabs"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-tabs', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function wavesUI()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Advance UI"], ['name' => "Waves"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.advance-ui-waves', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    // fullscreen slider
    public function fullscreenSlider()
    {
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image', 'isCustomizer' => false];
        return view('pages.fullscreen-slider-demo', ['pageConfigs' => $pageConfigs]);
    }
}
