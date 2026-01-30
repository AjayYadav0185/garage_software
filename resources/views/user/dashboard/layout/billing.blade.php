@extends('user.dashboard.layout.master')
@section('user-contant')

  <body>

    <style>
    .hover:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transform: translateZ(-5px);
      transition: all 0.3s ease-in-out;
    }

    .billing-icon {
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
          <div class="card-header supreme-container" style="display: block;">
            <div class="row">
            <div class="col-sm-12">
              <div class="d-flex align-items-center gap-2">
              <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                class="btn btn-primary go_forbtn"
                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;" data-toggle="tooltip"
                data-placement="top" title="Go Back">
                <i class="fa-sharp fa fa-arrow-left"></i>
              </a>&nbsp;&nbsp;
              {{-- <h4 class="mb-0">Shipments</h4> --}}
              </div>
            </div>
            </div>
          </div>

          <br>

          <div class="row px-4">

            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{route('user.rate-calculator')}}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="x4muou">
                  <img src="{{asset('billing_icon/Calculator.png')}}" class="billing-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Rate Calculator</h6>
                {{-- <p class="text-muted m-0 fw-600">Rate Calculator</p> --}}
                </div>
              </div>
              </a>
            </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{route('user.remittances')}}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="7qosew">
                  <img src="{{asset('billing_icon/cod.png')}}" class="billing-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">COD Remittance</h6>
                {{-- <p class="text-muted m-0 fw-600">COD Remittance</p> --}}
                </div>
              </div>
              </a>
            </div>
            </div>



            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{route('user.invoices')}}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="p95m1h">
                  <img src="{{asset('billing_icon/invoice.png')}}" class="billing-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Invoice</h6>
                {{-- <p class="text-muted m-0 fw-600">Invoice</p> --}}
                </div>
              </div>
              </a>
            </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{route('user.weight-reconciliation')}}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="34t64e">
                  <img src="{{asset('billing_icon/weight.png')}}" class="billing-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Weight Reconcilation</h6>
                {{-- <p class="text-muted m-0 fw-600">Weight Reconcilation</p> --}}
                </div>
              </div>
              </a>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="#" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="a41k2f">
                  <img src="{{asset('billing_icon/freeze.png')}}" class="billing-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Weight Freeze</h6>
                {{-- <p class="text-muted m-0 fw-600">Weight Freeze</p> --}}
                </div>
              </div>
              </a>
            </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{ route('user.creditpage') }}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="qejt0f">
                  <img src="{{asset('billing_icon/note.png')}}" class="billing-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Credit Note</h6>
                {{-- <p class="text-muted m-0 fw-600">Credit Note</p> --}}
                </div>
              </div>
              </a>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6  d-flex box-shadow">
            <div class="card box w-100 hover">
              <a href="{{ route('user.debitpage') }}" class="text-decoration-none">
              <div class="card-body">
                <div class="pb-2">
                <button type="button" class="btn m-b-15" fdprocessedid="lkcths">
                  <img src="{{asset('billing_icon/d_note.png')}}" class="billing-icon w-25 h-25">
                </button>
                </div>
                <div>
                <h6 class="fw-600 text-dark">Debit Note</h6>
                {{-- <p class="text-muted m-0 fw-600">Debit Note</p> --}}
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

    <!-- recharge model  -->
    <script src="https://unpkg.com/sweetalert%402.1.2/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @endsection