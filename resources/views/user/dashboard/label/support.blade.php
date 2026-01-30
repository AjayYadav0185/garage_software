@extends('user.dashboard.layout.master')

@section('user-contant')
    <style>
        .support-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
        }

        .support-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        }

        .icon-container {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 1rem;
        }

        .contact-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .contact-item:last-child {
            border-bottom: none;
        }

        .support-img {
            transition: transform 0.3s ease;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
        }

        .support-img:hover {
            transform: scale(1.05);
        }

        .section-title {
            font-weight: 600;
            color: #2d3748;
            position: relative;
            padding-left: 1.5rem;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 70%;
            background: #4a5568;
            border-radius: 3px;
        }

        /* Scrollable Department Section */
        .department-container {
            max-height: calc(120vh - 250px);
            overflow-y: auto;
            padding-right: 15px;
        }

        .fixed-window-height {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .card-body-container {
            flex: 1;
            min-height: 0;
        }

        .support-img-container {
            max-height: 280px;
            overflow: hidden;
        }

        /* Custom Scrollbar */
        .department-container::-webkit-scrollbar {
            width: 6px;
        }

        .department-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .department-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .department-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (max-width: 991px) {
            .department-container {
                max-height: none;
                overflow-y: visible;
            }

            .fixed-window-height {
                min-height: auto;
            }
        }
    </style>

    <div class="main-content fixed-window-height">
        <section class="section" style="margin-top:-34px; flex: 1;">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <div class="card border-0 shadow-sm h-100">
                        <!-- Header -->
                        <div class="card-header bg-transparent border-0">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                            class="btn btn-primary go_forbtn"
                                            style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                            data-toggle="tooltip" data-placement="top" title="Go Back">
                                            <i class="fa-sharp fa fa-arrow-left"></i>
                                        </a>&nbsp;&nbsp;
                                        <h4 class="mb-0">Support Center</h4>
                                        @if(get_role(Auth::user()->usertype) == 2)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#addSupportModal">
                                                <i class="fas fa-plus"></i> Add Support
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body px-lg-5 py-lg-4 card-body-container">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-lg-4 mb-4">
                                    <div class="support-card card h-100 ">
                                        <div class="card-body text-center px-4 d-flex flex-column">
                                            <div class="icon-container mx-auto">
                                                <i class="fas fa-headset"></i>
                                            </div>
                                            <h5 class="card-title font-weight-bold text-gradient">Rappidx Support</h5>
                                            <p class="card-text text-muted mb-4">24/7 dedicated support through multiple
                                                channels</p>
                                            <div class="bg-primary-soft p-3 rounded-lg">
                                                <p class="mb-0 text-dark">
                                                    Email us at:<br>
                                                    <a href="mailto:techsupport@rappidx.com" class="font-weight-bold">
                                                        techsupport@rappidx.com
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="support-img-container">
                                                <img src="{{ asset('support.png') }}" alt="Support"
                                                    class="support-img img-fluid w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-lg-8">
                                    {{-- <h5 class="section-title mb-4">Department Contacts</h5> --}}
                                    <div class="department-container">
                                        <div class="row">

                                            @foreach ($infos as $info)
                                                <div class="col-md-6 mb-2">
                                                    <div class="support-card card">
                                                        <div class="card-body p-2">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="bg-primary text-white rounded p-2">
                                                                    <i
                                                                        class="fas fa-{{ strtolower($info->name) === 'tech' ? 'tools' : 'headset' }} fa-lg"></i>
                                                                </div>
                                                                <h6 class="mb-0 ml-3 text-dark font-weight-bold">
                                                                    {{ $info->name }} Support
                                                                </h6>

                                                                @if (get_role(Auth::user()->usertype) == 2)
                                                                    <button class="btn btn-sm btn-link ml-auto edit-btn"
                                                                        type="button" data-section="{{ $info->name }}">
                                                                        <i class="fas fa-Edit fa-lg"></i></button>
                                                                @endif


                                                            </div>

                                                            {{-- Display Mode --}}
                                                            <div class="display-mode" id="display-{{$info->name }}">
                                                                <div class="contact-item">
                                                                    <i class="fa fa-volume-control-phone"
                                                                        aria-hidden="true"></i>
                                                                    <span class="text-dark">{{ $info->phone }}</span>
                                                                </div>
                                                                <div class="contact-item">
                                                                    <i class="fa fa-envelope mr-2" aria-hidden="true"></i>
                                                                    <a href="mailto:{{ $info->email }}"
                                                                        class="text-dark">{{ $info->email }}</a>
                                                                </div>
                                                                <div class="contact-item">
                                                                    <i class="fa fa-map-marker mr-2" aria-hidden="true"></i>
                                                                    <span class="text-muted">{{ $info->address }}</span>
                                                                </div>



                                                            </div>
                                                            <div class="d-flex align-items-center mb-2">
                                                                @if (get_role(Auth::user()->usertype) == 2)
                                                                    <button
                                                                        class="btn btn-sm btn-link ml-auto delete-btn text-danger"
                                                                        type="button" data-id="{{ $info->id }}"
                                                                        data-section="{{ $info->name }}">
                                                                        <i class="fas fa-trash fa-lg"></i>
                                                                    </button>
                                                                @endif
                                                            </div>



                                                            {{-- Edit Mode (Hidden by default) --}}
                                                            <form class="edit-mode" id="form-{{ $info->name }}"
                                                                style="display:none;">

                                                                <input type="hidden" name="id" value="{{ $info->id }}">
                                                                <div class="form-group">
                                                                    <label for="{{ $info->name }}">Title</label>
                                                                    <input type="text" class="form-control"
                                                                        id="{{ $info->name }}" name="name"
                                                                        value="{{ $info->name }}">
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="phone-{{$info->name }}">Phone</label>
                                                                    <input type="text" class="form-control"
                                                                        id="phone-{{ $info->name }}" name="phone"
                                                                        value="{{ $info->phone }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email-{{ $info->name }}">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email-{{ $info->name }}" name="email"
                                                                        value="{{ $info->email }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="address-{{ $info->name }}">Address</label>
                                                                    <input type="text" class="form-control"
                                                                        id="address-{{ $info->name }}" name="address"
                                                                        value="{{ $info->address }}">
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Save</button>
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm cancel-btn"
                                                                    data-section="{{ $info->name }}">Cancel</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="addSupportModal" tabindex="-1" role="dialog" aria-labelledby="addSupportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addSupportForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSupportModalLabel">Add Support</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.getElementById('addSupportForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = {
                title: this.title.value.trim(),
                phone: this.phone.value.trim(),
                email: this.email.value.trim(),
                address: this.address.value.trim(),
            };

            // Simple validation
            if (!formData.title || !formData.phone || !formData.email || !formData.address) {
                Swal.fire('Error', 'All fields are required', 'warning');
                return;
            }

            fetch("{{ route('user.addsupport') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(formData)
            })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        $('#addSupportModal').modal('hide'); // close modal
                        Swal.fire('Success', 'Support added successfully', 'success');
                        // Optionally refresh table/display
                        location.reload(); // simple way
                    } else {
                        Swal.fire('Error', response.message || 'Something went wrong', 'error');
                    }
                })
                .catch(() => {
                    Swal.fire('Error', 'Unexpected error occurred', 'error');
                });
        });
    });


</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleDisplay = (section, showForm) => {
            const display = document.getElementById(`display-${section}`);
            const form = document.getElementById(`form-${section}`);
            const editButton = document.querySelector(`.edit-btn[data-section="${section}"]`);

            display.style.display = showForm ? 'none' : 'block';
            form.style.display = showForm ? 'block' : 'none';
            editButton.style.display = showForm ? 'none' : 'inline-block';
        };

        const updateDisplayContent = (section, data) => {
            const display = document.getElementById(`display-${section}`);
            display.querySelector('.fa-volume-control-phone + span').textContent = data.phone;
            display.querySelector('.fa-envelope + a').textContent = data.email;
            display.querySelector('.fa-envelope + a').href = `mailto:${data.email}`;
            display.querySelector('.fa-map-marker + span').textContent = data.address;
        };

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                toggleDisplay(button.dataset.section, true);
            });
        });

        document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', () => {
                toggleDisplay(button.dataset.section, false);
            });
        });

        document.querySelectorAll('.edit-mode').forEach(form => {
            form.addEventListener('submit', e => {
                e.preventDefault();
                // const section = form.id.replace('form-', '');
                const id = form.querySelector('input[name="id"]').value.trim();
                const name = form.querySelector('input[name="name"]').value.trim();
                const phone = form.querySelector('input[name="phone"]').value.trim();
                const email = form.querySelector('input[name="email"]').value.trim();
                const address = form.querySelector('input[name="address"]').value.trim();

                // Simple validation rules
                if (!phone) {
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Phone number is required.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (!/^\d{10}$/.test(phone)) {
                    Swal.fire({
                        title: 'Invalid Phone',
                        text: 'Please enter a valid phone number (10 digits).',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (!email) {
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Email is required.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    Swal.fire({
                        title: 'Invalid Email',
                        text: 'Please enter a valid email address.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (!address) {
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Address is required.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                const data = {
                    id,
                    name,
                    phone,
                    email,
                    address,

                };

                fetch("{{ route('user.updatesupport') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                })
                    .then(res => res.json())
                    .then(response => {
                        if (response.success) {
                            updateDisplayContent(section, data);
                            toggleDisplay(section, false);
                            Swal.fire({
                                title: 'Success!',
                                text: 'Your information has been updated.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            // Optionally refresh table/display
                            location.reload();
                        } else {
                            Swal.fire({
                                title: 'Failed!',
                                text: response.message ||
                                    'There was an issue saving your data.',
                                icon: 'error',
                                confirmButtonText: 'Try Again'
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    });

            });
        });

    });

</script>



<script>
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        var section = $(this).data('section');
        if (!confirm("Are you sure you want to delete this record from " + section + "?")) {
            return;
        }

        $.ajax({
            url: "{{ url('user/deleteSupport') }}/" + id,
            type: "get",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);

                    // अगर DataTable है तो reload करो
                    if ($('#profile3-table').length) {
                        $('#profile3-table').DataTable().ajax.reload();
                        // Optionally refresh table/display
                        location.reload();
                    } else {
                        // नहीं है तो card remove कर दो
                        $(`button[data-id="${id}"]`).closest('.col-md-6').remove();
                    }
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                alert("Error: " + (xhr.responseJSON?.message ?? "Something went wrong"));
            }
        });
    });
</script>