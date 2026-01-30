@extends('user.dashboard.layout.master')
@section('user-contant')

  <body>
    <style>
    .hover:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transform: translateZ(-5px);
      transition: all 0.3s ease-in-out;
    }

    .resource-icon {
      width: 80px;
      height: 80px;
    }
    </style>
    <div id="app">
    <div class="main-wrapper main-wrapper-1 supreme-container">
      <!-- Main Content -->
      <div class="main-content">
      <section class="section">
        <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
          <div class="card" style="text-align: center">
          <div class="card-header" style="display: block;">
            <div class="row">
            <div class="col-sm-12">
              <div class="d-flex align-items-center gap-2">
              <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                class="btn btn-primary go_forbtn"
                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;" data-toggle="tooltip"
                data-placement="top" title="Go Back">
                <i class="fa-sharp fa fa-arrow-left"></i>
              </a>&nbsp;&nbsp;
              <h4 class="mb-0">Resource Center</h4>
              </div>
            </div>
            </div>
          </div>
          <hr>
          {{-- <br> --}}
          <div class="row px-4">
            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{route('user.pincode')}}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="34t64e">
                  <img src="{{asset('resource_icon/pincode.png')}}" class="resource-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Pincode Serviceability</h6>

                </div>
              </div>
              </a>
            </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{route('user.delivery_tat')}}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="qrjh4">
                  <img src="{{asset('resource_icon/tat.png')}}" class="resource-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Delivery TAT</h6>
                </div>
              </div>
              </a>
            </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="#" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="6nspa5">
                  <img src="{{asset('resource_icon/zone.png')}}" class="resource-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Zone Mapping</h6>

                </div>
              </div>
              </a>
            </div>
            </div> --}}
            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{ route('user.packing_guideline') }}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="7qosew">
                  <img src="{{asset('resource_icon/packing.png')}}" class="resource-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Packing Guidelines</h6>

                </div>
              </div>
              </a>
            </div>
            </div>
            {{-- Invoice --}}
            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{ route('user.prohibited_items') }}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="7qosew">
                  <img src="{{asset('resource_icon/icon.png')}}" class="resource-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Prohibited Items</h6>

                </div>
              </div>
              </a>
            </div>
            </div>
          </div>
          </div>
      </section>
      </div>
    </div>
    </div>
  @endsection