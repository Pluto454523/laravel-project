@extends('layouts.master') {{-- การสืบทอดโฟลเดอร์ --}}
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @stop {{-- หัวข้อ title html --}}
@section('content')

    {!! Form::open([
        'action' => 'App\Http\Controllers\UserController@insert',
        'method' => 'post',
        'enctype' => 'multipart/form-data',
    ]) !!}


    <h1>ข้อมูลผู้ใช้งาน</h1>
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('user') }}">ข้อมูลผู้ใช้งาน</a></li>
        <li class="active">เพิ่มข้อมูลผู้ใช้งาน</li>
    </ul>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>

    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>ข้อมูลผู้ใช้</strong>
            </div>
        </div>

        <div class="panel-body">
            <table class="table table-bordered bs-table">
                <tr>
                    <td>{{ Form::label('name', 'ชื่อผู้ใช้งาน') }}</td>
                    <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('email', 'อีเมล์') }}</td>
                    <td>{{ Form::text('email', Request::old('email'), ['class' => 'form-control']) }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('password', 'รหัสผ่าน') }}</td>
                    <td>{{ Form::password('password', ['class' => 'form-control']) }}</td>
                </tr>

            </table>
        </div>

        <div class="panel-footer">
            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        </div>


    </div>

    </div>

    <script>

        $(document).ready(function () {
            $('button:reset').click(function () {
                window.location.href = '/user';
            });
        });

    </script>

    {!! Form::close() !!}



@endsection
