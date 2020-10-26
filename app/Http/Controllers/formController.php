<?php

namespace App\Http\Controllers;

class FormController extends Controller
{
    public function formElement()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form Elements"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.form-elements', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function formSelect2()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form Select2"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.form-select2', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function formValidation()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form Validation"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.form-validation', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function masksForm()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form Mask"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.form-masks', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function formEditor()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form Editor"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.form-editor', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function fileUploads()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form File Upload"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.form-file-uploads', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function formLayouts()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form Layouts"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.form-layouts', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
    public function formWizard()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Form"], ['name' => "Form Wizard"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.form-wizard', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
    }
}
