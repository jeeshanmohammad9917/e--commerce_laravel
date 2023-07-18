<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Dashboard - LearnVern Store Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="{{asset('admin_assets').'/css/styles.css'}}" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
@include('admin.admin_layout.header')

   <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
       
          @include('admin.admin_layout.sidebar_nav')
       </div>
        <div id="layoutSidenav_content">
            @yield('content')
            @include('admin.admin_layout.footer')
        </div>
   </div>
@include('admin.admin_layout.footer_scripts')


 
    </body>
</html>