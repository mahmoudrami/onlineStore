    <!DOCTYPE html>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>@yield('title')</title>

            <!-- Custom fonts for this template-->
            <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
                type="text/css">
            <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">

            <!-- Custom styles for this template-->
            <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
            @yield('css')
        </head>

        <body id="page-top">

            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Sidebar -->
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center"
                        href="{{ route('admin.homePage') }}">
                        <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</sup></div>
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.homePage') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>

                    <!-- Divider -->
                    <!-- Nav Item - Pages Collapse Menu -->
                    @isset($adminPermissions)
                        @foreach ($adminPermissions as $adminPermission)
                            <hr class="sidebar-divider m-0">
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="" data-toggle="collapse"
                                    data-target="#collapse{{ $adminPermission->name }}" aria-expanded="true"
                                    aria-controls="collapse{{ $adminPermission->name }}">
                                    {!! $adminPermission->icon !!}
                                    <span>{{ Str::title($adminPermission->name) }}</span>
                                </a>
                                <div id="collapse{{ $adminPermission->name }}" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <a class="collapse-item" href="{{ route($adminPermission->route_name) }}">All
                                            {{ Str::title($adminPermission->name) }}</a>
                                        {{-- <h1>{{ $adminPermission->route_name }}</h1> --}}
                                        @php
                                            $create_route = Str::replaceLast(
                                                'index',
                                                'create',
                                                $adminPermission->route_name,
                                            );

                                        @endphp
                                        @if (has_permission($create_route))
                                            <a class="collapse-item" href="{{ route($create_route) }}">Add New</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endisset
                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                </ul>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                            <!-- Sidebar Toggle (Topbar) -->
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>

                            <p class="mt-3">
                                <a href="{{ route('admin.homePage') }}" class="text-gray-600 text-decoration-none">Home
                                    Page</a><span>/</span>
                                @yield('breadcrumb')
                            </p>

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">

                                <!-- Nav Item - Alerts -->
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-bell fa-fw"></i>
                                        <!-- Counter - Alerts -->
                                        @if (Auth::guard('admin')->user()->unreadnoifications)
                                            <span
                                                class="badge badge-danger badge-counter">{{ Auth::guard('admin')->user()->unreadnoifications }}+</span>
                                        @endif
                                    </a>
                                    <!-- Dropdown - Alerts -->
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="alertsDropdown">

                                        <h6 class="dropdown-header">
                                            Notifications
                                        </h6>
                                        @foreach (Auth::guard('admin')->user()->notifications as $notification)
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-primary">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="small text-gray-500">
                                                        {{ $notification->created_at->format('F d,Y') }}</div>
                                                    <span
                                                        class="font-weight-bold">{{ $notification->data['msg'] }}</span>
                                                </div>
                                            </a>
                                        @endforeach

                                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                            Alerts</a>
                                    </div>
                                </li>

                                <!-- Nav Item - Messages -->
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-envelope fa-fw"></i>
                                        <!-- Counter - Messages -->
                                        <span class="badge badge-danger badge-counter">7</span>
                                    </a>
                                    <!-- Dropdown - Messages -->
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="messagesDropdown">
                                        <h6 class="dropdown-header">
                                            Message Center
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle"
                                                    src="{{ asset('backend/img/undraw_profile_1.svg') }}"
                                                    alt="...">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">Hi there! I am wondering if you can help me
                                                    with
                                                    a
                                                    problem I've been having.</div>
                                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle"
                                                    src="{{ asset('backend/img/undraw_profile_2.svg') }}"
                                                    alt="...">
                                                <div class="status-indicator"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate">I have the photos that you ordered last
                                                    month,
                                                    how
                                                    would you like them sent to you?</div>
                                                <div class="small text-gray-500">Jae Chun · 1d</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle"
                                                    src="{{ asset('backend/img/undraw_profile_3.svg') }}"
                                                    alt="...">
                                                <div class="status-indicator bg-warning"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate">Last month's report looks great, I am very
                                                    happy
                                                    with
                                                    the progress so far, keep up the good work!</div>
                                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img class="rounded-circle"
                                                    src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                    alt="...">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div>
                                                <div class="text-truncate">Am I a good boy? The reason I ask is because
                                                    someone
                                                    told me that people say this to all dogs, even if they aren't
                                                    good...
                                                </div>
                                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">Read
                                            More
                                            Messages</a>
                                    </div>
                                </li>

                                <div class="topbar-divider d-none d-sm-block"></div>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('admin')->user()->name }}</span>
                                        <img class="img-profile rounded-circle" style="object-fit: cover"
                                            src="{{ Auth::guard('admin')->user()->img_path }}">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Activity Log
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item" data-toggle="modal">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Logout

                                            </button>
                                        </form>
                                    </div>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            @yield('content')
                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2020</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
            <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Status Not Active Modal-->
            <div class="modal fade" id="NotActiveModal" tabindex="-1" role="dialog"
                aria-labelledby="NotActiveLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="NotActiveLabel">Activation Status</h5>
                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure make all items Not Active</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary confirmAll" data-action="not_active">Not Active</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Status Active Modal-->
            <div class="modal fade" id="ActiveModal" tabindex="-1" role="dialog" aria-labelledby="ActiveLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ActiveLabel">Activation Status</h5>
                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure make all items Active</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary confirmAll" data-action="active">Active</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Delete Modal-->
            <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DeleteLabel">Delete Modal</h5>
                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure make all items Delete</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary confirmAll" data-action="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



            <script>
                function showImage(e) {
                    const [file] = e.target.files
                    if (file) {
                        prevImage.src = URL.createObjectURL(file)
                    }
                }

                function showImages(e) {
                    const images = e.target.files
                    console.log(images);

                    if (images) {
                        for (image of images) {
                            src = URL.createObjectURL(image)
                            const element = document.createElement('div');
                            element.classList.add('wrapper-delete');
                            element.innerHTML = `<span onclick="deleteImg(event,id=0)">X</span>
                <label><img class="img-thumbnail prevImage" width="150px"
                        src="${src}" alt="Upload Image" width="350px"
                        class="gallery" style="object-fit: cover"></label>`
                            document.querySelector('#gallery').appendChild(element);

                        }
                        // prevImage.src = URL.createObjectURL(file)
                    }
                }

                function deleteItem(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.closest('form').submit();
                        }
                    });
                }
            </script>

            <script>
                let itemsIds = [];
                document.querySelectorAll('[name="itemsIds[]"]').forEach(ele => {
                    // here if use first way because this work first reload page
                    ele.onchange = () => {
                        // itemsIds = []; // here if use second way this work when just change status checkbox

                        // itemsIds.push(ele.value);
                        // first way to check id value exist in itemsIds array if found delete
                        if (itemsIds.indexOf(ele.value) != -1) {
                            itemsIds.splice(itemsIds.indexOf(ele.value), 1);
                        } else {
                            itemsIds.push(ele.value);
                        }
                        console.log(itemsIds);

                        // second way
                        // document.querySelectorAll('[name="itemsIds[]"]:checked').forEach(el => {
                        //     itemsIds.push(el.value);
                        // })


                        if (itemsIds.length > 0) {
                            document.querySelectorAll('.event').forEach(el => {
                                el.removeAttribute('disabled');
                            });

                        } else {
                            document.querySelectorAll('.event').forEach(el => {
                                el.setAttribute('disabled', 'true');
                            });
                        }

                    }
                });
                // if (document.querySelector('#delete-items') != null) {
                document.querySelectorAll('.confirmAll').forEach(el => {
                    el.onclick = () => {
                        let action = el.getAttribute('data-action');
                        let url = "{{ url('/admin/changeStatus/' . Request::segment(2)) }}";
                        $.ajax({
                            method: 'POST',
                            url: url,
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'itemsIds': itemsIds,
                                'action': action,
                            },
                            success: function(res) {
                                // fadeOut

                                if (res == 'active') {
                                    itemsIds.forEach((id) => {
                                        document.querySelector('#label-' + id).classList.add(
                                            'btn-success')
                                        document.querySelector('#label-' + id).classList.remove(
                                            'btn-danger')

                                        document.querySelector('#label-' + id).innerHTML =
                                            'active';
                                        $('#ActiveModal').modal('hide');

                                    })
                                } else if (res == 'not_active') {
                                    itemsIds.forEach((id) => {
                                        document.querySelector('#label-' + id).classList.add(
                                            'btn-danger')
                                        document.querySelector('#label-' + id).classList.remove(
                                            'btn-success')

                                        document.querySelector('#label-' + id).innerHTML =
                                            'not_active';
                                        $('#NotActiveModal').modal('hide');
                                    })
                                } else {
                                    itemsIds.forEach((id) => {
                                        // using JQuery hide model in 3 second and remove tr table

                                        $('#tr-' + id).hide(2000);
                                        $('#DeleteModal').modal('hide');
                                    })
                                }
                                itemsIds = [];
                                document.querySelectorAll('.event').forEach(el => {
                                    el.setAttribute('disabled', 'true');
                                });
                                document.querySelectorAll('[type="checkbox"]:checked').forEach(el => {
                                    el.checked = false;
                                })
                            }
                        });

                    }
                })

                // select all check box in page js dom
                // if (document.querySelector('#checkboxall') != null) {
                document.querySelector('#checkboxall')?.addEventListener('click', () => {
                    itemsIds = [];
                    document.querySelectorAll('[name="itemsIds[]"]').forEach(el => {

                        if (document.querySelector('#checkboxall').checked == true) {

                            document.querySelectorAll('.event').forEach(el => {
                                el.removeAttribute('disabled');
                            });
                            el.checked = true
                            itemsIds.push(el.value);
                        } else {
                            itemsIds = [];
                            document.querySelectorAll('.event').forEach(el => {
                                el.setAttribute('disabled', 'true');
                            });
                            el.checked = false
                        }
                    })
                    console.log(itemsIds);

                })
                // }

                // select all check box in page

                // $(document).on('click', '#checkboxall', function() {
                //     $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
                // })
            </script>
            <script>
                let authID = "{{ Auth::guard('admin')->user()->id }}"
                let guard = 'admin'
            </script>
            @vite(['resources/js/app.js'])
            @yield('js')
        </body>

    </html>
