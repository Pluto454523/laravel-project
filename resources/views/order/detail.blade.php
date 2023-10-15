@extends('layouts.master') {{-- การสืบทอดโฟลเดอร์ --}}
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @stop {{-- หัวข้อ title html --}}
@section('content')
    <div class="container" ng-app="app" ng-controller="controller">
        <h1>ข้อมูลสินค้า</h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('order') }}">รายการข้อมูลสั่งซื้อ</a></li>
            <li class="active">Detail of</li>
        </ul>

        <input id="order_id" type="hidden" value="{{$order->id}}">

        <div class="panel-body">
            <table class="table table-bordered bs-table">
                <thead>
                    <tr>
                        <th>หัวข้อ</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>

                <tr>
                    <td>เลขที่ใบสั่งซื้อ</td>
                    <td>{{ $order->ref_id }} </td>
                </tr>

                <tr>
                    <td>ชื่อลูกค้า</td>
                    <td>{{ $order->user->name }} </td>
                </tr>

                <tr>
                    <td>วันที่สั่งซื้อสินค้า</td>
                    <td>{{ $order->created_at->format('Y/m/d') }} </td>
                </tr>

                <tr>
                    <td>สถานะการชำระเงิน</td>
                    <td> <label class="switch">
                            <input type="checkbox" id="toggleSwitch" ng-click="toggleSwitch()"
                                {{ $order->status == 2 ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label></td>
                </tr>

            </table>

            <br>

            <table class="table table-bordered bs-table">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>

                    </tr>
                </thead>

                <tbody>
                   

                 


                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">รวม</th>
                    </tr>
                </tfoot>

            </table>


        </div>

    </div>


    <script>
        const toggleSwitch = document.getElementById('toggleSwitch');
        toggleSwitch.addEventListener('click', () => {
            let id = document.querySelector('#order_id').value;
            let status = toggleSwitch.checked ? 2 : 1;
            
            setTimeout(() => {
                window.location.href = `./update/${id}/${status}`;
            }, 500);
        });
    </script>



@endsection
