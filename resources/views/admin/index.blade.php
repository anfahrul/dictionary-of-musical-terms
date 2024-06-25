<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kamus Istilah | {{ $title }}</title>
    <link
      rel="shortcut icon"
      type="image/png"
      href="/images/logos/favicon.png"
    />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="/css/styles.min.css" />
  </head>

  <body>
    <!--  Body Wrapper -->
    <div
      class="page-wrapper"
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin6"
      data-sidebartype="full"
      data-sidebar-position="fixed"
      data-header-position="fixed"
    >

        @include('admin.sidebar')

      <!--  Main wrapper -->
      <div class="body-wrapper">

        @include('admin.header')

        <div class="container-fluid">
            @yield('main-content')
        </div>
      </div>
    </div>
    <script src="/libs/jquery/dist/jquery.min.js"></script>
    <script src="/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/sidebarmenu.js"></script>
    <script src="/js/app.min.js"></script>
    <script src="/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/libs/simplebar/dist/simplebar.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

    @yield('script')
  </body>
</html>
