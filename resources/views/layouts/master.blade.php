<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bikeshop | จำหน่าอะไหล่จักรยานออนไลน์')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

</head>

<body>
    <script src="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"></script>

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">BIKE-SHOP</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li> 
                @guest
                    {{-- ไม่มี --}}
                @else
                    <li><a href="{{ URL::to('product') }}">จัดการข้อมูลสินค้า </a></li>
                    <li><a href="{{ URL::to('category') }}">จัดการประเภทสินค้า </a></li>
                    <li><a href="{{URL::to('order')}}">รายการสั่งซื้อ</a></li> 
                    <li><a href="{{URL::to('user')}}">จัดการผู้ใช้</a></li>
                @endguest
                </ul>

                <ul class="nav navbar-nav navbar-right"> 
                @guest
                    <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                    <li><a href="{{ route('register') }}">ลงทะเบียน</a></li> 
                @else
                    <li><a href="#">{{ Auth::user()->name }} </a></li>
                    <li><a href="{{ route('logout') }}">ออกจากระบบ </a></li> 
                @endguest
                </ul>

                {{-- <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li>
                    <li><a href="{{ URL::to('product') }}">ข้อมูลสินค้า</a></li>
                    <li><a href="{{ URL::to('category') }}">ประเภทสินค้า</a></li>
                    <li><a href="#">รายงาน</a></li>
                </ul> --}}

                @guest
                @else
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ URL::to('cart/view') }}"><i class="fa fa-shopping-cart"></i> ตะกร้า
                            <span class="label label-danger">
                                @if (Session::has('cart_items'))
                                    {!! count(Session::get('cart_items')) !!}
                                @else
                                    {{ count([]) }}
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
                @endguest

            </div>
        </div>
    </nav>

    <div class="container">
        <div style="text-align: center;">
            <h2>Bikeshop System2</h2>
        </div> @yield('content')

        @if (session('msg'))
            @if (session('ok'))
                <script>
                    toastr.success("{{ session('msg') }}")
                </script>
            @else
                <script>
                    toastr.error("{{ session('msg') }}")
                </script>
            @endif
        @endif
    </div>
</body>

</html>



{{-- <a href="#" class="btn btn-default"><i class="fa fa-home"></i> หน้าหลัก</a>
        <a href="#" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</a>
        <a href="#" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>หัวข้อ</strong>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคาขาย</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>P001</td>
                            <td>ชุดจักรยาน ขนาด XL</td>
                            <td>2500.00</td>
                        </tr>
                        <tr>
                            <td>P002</td>
                            <td>หมวกกันน็อก รุ่น DL330</td>
                            <td>1500.00</td>
                            </tr>
                            <tr>
                            <td>P003</td>
                            <td>ชุดเกียร์Shimano รุ่น SH-001</td>
                            <td>4500.00</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>

        
        <a href="#" class="btn btn-default">Default</a>
        <a href="#" class="btn btn-primary">Primary</a>
        <a href="#" class="btn btn-info">Info</a>
        <a href="#" class="btn btn-success">Success</a>
        <a href="#" class="btn btn-warning">Warning</a>
        <a href="#" class="btn btn-danger">Danger</a>

        <div class="form-group has-error">
            <label>ชื่อ-นามสกุล</label>
            <input type="text" class="form-control">
            <div class="help-block">กรุณากรอกชื่อ-นามสกุล</div>
            </div>
            <div class="form-group has-error">
            <label>ที่อยู่</label>
            <textarea rows="4" class="form-control"></textarea>
            <div class="help-block">กรุณากรอกที่อยู่</div>
            </div>
            <div class="form-group">
            <button class="btn btn-primary">เพิ่มข้อมูล</button>
        </div>

        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
            <strong>Success</strong> ข้อความ
        </div>
        <div class="alert alert-info alert-dismissalbe">Success ข้อความ</div>
        <div class="alert alert-warning alert-dismissalbe">Warning ข้อความ</div>
        <div class="alert alert-danger alert-dismissalbe">Danger ข้อความ</div>
    </div>
    <script>
       Command: toastr["error"]("DDDD", "Hello")

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    </script> --}}
