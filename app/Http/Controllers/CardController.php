<?php

namespace App\Http\Controllers;

class CardController extends Controller
{
    public function cardBasic()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Cards"], ['name' => "Cards Basic"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.cards-basic', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function cardAdvance()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Cards"], ['name' => "Cards Advance"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.cards-advance', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function cardsExtended()
    {
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Cards"], ['name' => "Cards Advance"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.cards-extended', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
}
