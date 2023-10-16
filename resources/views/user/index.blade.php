@extends('layouts.master') {{-- การสืบทอดโฟลเดอร์ --}}
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @stop {{-- หัวข้อ title html --}}
@section('content')
    <h1>จัดการข้อมูลผู้ใช้งาน</h1>
    <ul class="breadcrumb">
        <li class="active">จัดการข้อมูลผู้ใช้งาน</li>
    </ul>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>จัดการข้อมูลผู้ใช้งาน</strong>
            </div>
        </div>
        <div class="panel-body">
            {{ csrf_field() }}

            </form>
            <br>
            <table class="table table-bordered bs-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>วันที่สร้าง</th>
                        <th>การทำงาน</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $o)
                        <tr>
                            <td> {{ $o->id }} </td>
                            <td> {{ $o->name }} </td>
                            <td> {{ $o->email }} </td>
                            <td> {{ $o->created_at }} </td>
                            <td><a href="{{ URL::to('user/edit/' . $o->id) }}" class="btn btn-info"> <i class="fa fa-edit"></i>
                                    แก้ไข</a>
                                <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $o->id }}">
                                    <i class="fa fa-trash"></i> ลบ</a>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <a href="{{ URL::to('/user/edit') }}" class="btn btn-success btn-block">
                <i class="fa fa-plus"></i> เพิ่มชื่อผู้ใช้งาน</a>
            
            

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function() {
                var id = $(this).attr('id-delete');
                if (confirm('คุณต้องการลบข้อมูลใช่หรือไม่')) {
                    window.location.href = '/user/remove/' + id;
                }
            });
        });
    </script>


@endsection
