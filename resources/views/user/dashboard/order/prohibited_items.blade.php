@extends('user.dashboard.layout.master')

@section('user-contant')
    <div class="main-content supreme-container">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header supreme-container" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <h4>Prohibited Items</h4>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                            class="btn btn-primary mr-1 go_forbtn float-right"
                                            style="color:white;border-radius: 5px;padding: 0.3rem 0.8rem !important;"
                                            data-toggle="tooltip" data-placement="top" title="Go Back" type="submit">
                                            <i class="fa-sharp fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body text-center">

                                <!-- View PDF inside iframe -->
                                <iframe src="{{ asset('packing_guidelines/packing.pdf') }}" width="100%" height="600px"
                                    style="border:1px solid #ccc;"></iframe>
                                <div class="d-flex justify-content-center align-items-center gap-4 mt-4 flex-wrap">
                                    <!-- Download Button -->
                                    <a href="{{ asset('packing_guidelines/packing.pdf') }}" class="btn btn-primary"
                                        download>
                                        <i class="fa fa-download"></i> Download Prohibited Items
                                    </a>


                                    @if (get_role(Auth::user()->usertype) == 2)
                                        <!-- Upload Form -->
                                        <form action="{{ route('user.packing_guideline_upload') }}" method="POST"
                                            enctype="multipart/form-data" class="d-flex align-items-center gap-2"
                                            style="padding-left:10px;">
                                            @csrf
                                            <div class="form-group mb-0">
                                                <label for="pdf_file" class="sr-only">Upload PDF</label>
                                                <input type="file" name="pdf_file" id="pdf_file"
                                                    class="form-control-file" accept="application/pdf" required>
                                                <input type="hidden" name="type" id="type" value="2"
                                                    class="form-control-file" >
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-upload"></i> Upload
                                            </button>
                                        </form>
                                    @endif
                                </div>



                                @if (session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
