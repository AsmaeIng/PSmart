{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Knowledge Licensing Page')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-knowledge.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- knowledge Licensing -->
<div class="section" id="knowledge-licensing">
  <div class="row knowledge-content">
    <!-- Licenses -->
    <div class="col s12 licenses">
      <div class="card-border-gray pb-3">
        <div class="row">
          <div class="col s12 m6 l6 card-width">
            <div class="card">
              <div class="card-content">
                <h5 class="mb-5"><i class="material-icons purple-text"> card_travel </i> Buying</h5>
                <p class="mb-3"><a href="licensing/detail">How do licenses work for any plugins?</a>
                </p>
                <p class="mb-3"><a href="licensing/detail">How Does The Envato Market Affiliate
                    Program Work?</a></p>
                <p class="mb-3"><a href="licensing/detail">I’m making a logo. What license do I
                    need?</a></p>
                <p class="mb-3"><a href="licensing/detail">I’m making a video - which license do I
                    need?</a></p>
                <p class="mb-3"><a href="licensing/detail">Do I need a Regular License or an
                    License?</a></p>
                <p><a class="purple-text" href="licensing/detail">Read More...</a></p>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l6 card-width">
            <div class="card">
              <div class="card-content">
                <h5 class="mb-5"><i class="material-icons purple-text"> credit_card </i> Payments</h5>
                <p class="mb-3"><a href="licensing/detail">View and Download invoices</a></p>
                <p class="mb-3"><a href="licensing/detail">Where Is My Purchase Code?</a></p>
                <p class="mb-3"><a href="licensing/detail">What is Item Support?</a></p>
                <p class="mb-3"><a href="licensing/detail">Can I Get A Refund?</a></p>
                <p class="mb-3"><a href="licensing/detail">Why is there a minimum $20 credit on
                    Envato Markets?</a></p>
                <p><a class="purple-text" href="licensing/detail">Read More...</a></p>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l6 card-width">
            <div class="card">
              <div class="card-content">
                <h5 class="mb-5"><i class="material-icons purple-text"> vertical_align_bottom </i> Downloads</h5>
                <p class="mb-3"><a href="licensing/detail">Download Limit Reached</a></p>
                <p class="mb-3"><a href="licensing/detail">How To Download Your Items</a></p>
                <p class="mb-3"><a href="licensing/detail">Problems Downloading A File</a></p>
                <p class="mb-3"><a href="licensing/detail">Update a Purchased Item</a></p>
                <p class="mb-3"><a href="licensing/detail">Using A Download Manager</a></p>
                <p><a class="purple-text" href="licensing/detail">Read More...</a></p>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l6 card-width">
            <div class="card">
              <div class="card-content">
                <h5 class="mb-5"><i class="material-icons purple-text"> local_post_office </i> Item Support</h5>
                <p class="mb-3"><a href="licensing/detail">Authors Item Support FAQ</a></p>
                <p class="mb-3"><a href="licensing/detail">Rating or Review Removal Policy</a></p>
                <p class="mb-3"><a href="licensing/detail">How to contact an author</a></p>
                <p class="mb-3"><a href="licensing/detail">What is Item Support?</a></p>
                <p class="mb-3"><a href="licensing/detail">Bundled Plugins</a></p>
                <p><a class="purple-text" href="licensing/detail">Read More...</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection