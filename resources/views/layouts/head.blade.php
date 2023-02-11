		<meta content="Tracking Panel" name="description" />
        <meta content="Maersk" name="author" />
        <link rel="shortcut icon" href="{{ URL::asset('image/maersk.ico')}}">

        @yield('css')

        
        <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <!-- DataTables -->
        <link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />

        <!-- Responsive datatable examples -->
        <link href="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet">

        <link href="{{ URL::asset('assets/plugins/ion-rangeslider/ion.rangeSlider.skinModern.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/metismenu/dist/metisMenu.min.css">        
        <link href="{{ URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <style>
            @media print{
                @page {size: landscape}
                .table-print{
                    margin-top: 10px;
                }
                .table-print thead th{
                    border-color: black;
                }
                .table-print thead tr{
                    border-color: black;
                }
                .table-print td{
                    border-color: black;
                }
            }
            body{
                font-family: maersktext;
                background-color: #f5f7fa;
            }
            .side-menu{
                background-color: white;
                /* box-shadow: 2px 0px 3px -2px rgba(0, 0, 0, 0.15); */
            }
            .topbar .topbar-left{
                background: white;
                /* box-shadow: 2px 0px 3px -2px rgba(0, 0, 0, 0.15); */
            }
            #sidebar-menu > ul > li > a.active{
                background: #444d63;
                color: white;
            }
            #sidebar-menu > ul > li > a.active i{
                color: white;
            }
            #sidebar-menu > ul > li > a:hover, #sidebar-menu > ul > li > a:focus, #sidebar-menu > ul > li > a:active{
                color: white;
                background-color: #2a3142;
            }
            .menu-title{
                color:#42B0D5;
                font-weight: bold
            }
            #sidebar-menu > ul > li a{
                padding-top:12px;
                font-size:12pt;
                color:#42B0D5;
            }
            #sidebar-menu > ul > li a i{
                font-size:12pt;
                line-height: 1.3rem;
                color:#42B0D5;
            }

            .submenu li a:hover{
                background-color: #2a3142;
            }
            .submenu li.active > a{
                color: #2a3142;
                background-color: white;
            }
            .preloader{
                width: 100%;
                height: 100%;
                top: 0px;
                position: fixed;
                z-index: 99999;
                background: #fdfdfdb8;
                margin: 0 auto;
                display: none;
            }
            .circular{
                transform-origin: center center;
                width: 250px;
                position: absolute;
                top: 320px;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                margin: auto;
            }
            a:hover{
                color: #42B0D5;
            }
        </style>
