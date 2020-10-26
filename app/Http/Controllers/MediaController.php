<?php

namespace App\Http\Controllers;

class MediaController extends Controller
{
    public function mediaGallery()
    {
        // breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Media Gallery Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.media-gallery-page', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function hoverEffect()
    {
        // breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Media Hover Effects Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.media-hover-effects', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
