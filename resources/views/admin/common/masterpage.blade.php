<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>{{$settings->title}}</title>

   <link rel="apple-touch-icon" href="{{url("/$settings->favicon")}}">
   <link rel="shortcut icon" type="image/png" href="{{url("/$settings->favicon")}}">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/base/vendor.bundle.base.css')}}"> 
  <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://silemkerma.kemdikbud.go.id/assets/DataTables-1.10.22/media/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="{{asset('/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
table.dataTable > thead .sorting:before,
table.dataTable > thead .sorting_asc:before,
table.dataTable > thead .sorting_desc:before,
table.dataTable > thead .sorting_asc_disabled:before,
table.dataTable > thead .sorting_desc_disabled:before {
  right: none !important;
  content: none !important;
}
table.dataTable > thead .sorting:after,
table.dataTable > thead .sorting_asc:after,
table.dataTable > thead .sorting_desc:after,
table.dataTable > thead .sorting_asc_disabled:after,
table.dataTable > thead .sorting_desc_disabled:after {
  right: none !important;
  content: none !important;
}
.custom-select-sm{
  width:55px !important;
}
</style>
<body>

    <!-- partial:partials/_navbar -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{route('index')}}"><img src="{{url("/$settings->logo_dark")}}" class="me-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{route('index')}}"><img src="{{url("/$settings->favicon_dark")}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('images/faces/face28.jpg')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{route('admin/setting')}}">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href='{{route('logout')}}' onclick="return confirm('Are you sure you want to logout?');">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_sidebar -->
          <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item {{ Request::is('admin/index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('index') }}">
                  <i class="ti-shield menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item {{ Request::is('admin/setting') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin/setting')}}">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Setting</span>
                </a>
              </li>
              <li class="nav-item {{ Request::is('admin/profile') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin/profile')}}">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Profile</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-menu" aria-expanded="false" aria-controls="ui-menu">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Menu</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-menu">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/addmenu')}}">Add Menu</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/viewmenu')}}">View Menu</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-Services" aria-expanded="false" aria-controls="ui-Services">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Services</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-Services">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/addservice')}}">Add Services</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/viewservice')}}">View Services</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-Portfolio" aria-expanded="false" aria-controls="ui-Portfolio">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Portfolio</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-Portfolio">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/addportfolio')}}">Add Portfolio</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/viewportfolio')}}">View Portfolio</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/viewportfoliocategory')}}">View Portfolio Category</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-Experience" aria-expanded="false" aria-controls="ui-Experience">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Experience</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-Experience">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/addexperience')}}">Add Experience</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/viewexperience')}}">View Experience</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-Education" aria-expanded="false" aria-controls="ui-Education">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Education</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-Education">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/addeducation')}}">Add Experience</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/vieweducation')}}">View Experience</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-Skills" aria-expanded="false" aria-controls="ui-Skills">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Skills</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-Skills">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/addskills')}}">Add Skills</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/viewskills')}}">View Skills</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-Testimonial" aria-expanded="false" aria-controls="ui-Testimonial">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Testimonial</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-Testimonial">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/addtestimonial')}}">Add Testimonial</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/viewtestimonial')}}">View Testimonial</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-Enquiry" aria-expanded="false" aria-controls="ui-Enquiry">
                  <i class="ti-palette menu-icon"></i>
                  <span class="menu-title">Enquiry</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-Enquiry">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/contactenquiry','all')}}">All Enquiry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/contactenquiry','resolved')}}">Resolved Enquiry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/contactenquiry','pending')}}">Pending Enquiry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin/contactenquiry','reject')}}">Reject Enquiry</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item {{ Request::is('logout') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('logout')}}" onclick="return confirm('Are you sure you want to logout?');">
                  <i class="ti-power-off menu-icon"></i>
                  <span class="menu-title">Logout</span>
                </a>
              </li>
            </ul>
          </nav>
          <!-- partial -->



          @yield('content')




        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
  
    <!-- plugins:js -->
    <script src="{{asset('vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/chart.js')}}"></script>
    <script src="{{asset('js/file-upload.js')}}"></script>
    <!-- End custom js for this page-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://silemkerma.kemdikbud.go.id/assets/DataTables-1.10.22/media/js/jquery.dataTables.js"></script>
    <script src="https://silemkerma.kemdikbud.go.id/assets/DataTables-1.10.22/media/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js"></script>
    <script>
      CKEDITOR.ClassicEditor.create(document.getElementById("Editor"), {
        toolbar: {
            items: [
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType'
        ]
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(function() {
      $("#example").tablesorter();
    });
    $(function() {
      $("#example").tablesorter({ sortList: [[0,0], [1,0]] });
    });
    </script>
  </body>
  
  </html>