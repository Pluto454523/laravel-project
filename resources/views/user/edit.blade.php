@extends('layouts.master') {{-- การสืบทอดโฟลเดอร์ --}}
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @stop {{-- หัวข้อ title html --}}
@section('content')


    {!! Form::model($user, [
        'action' => 'App\Http\Controllers\UserController@update',
        'method' => 'post',
        'enctype' => 'multipart/form-data',
    ]) !!}

    <h1>ข้อมูลผู้ใช้งาน</h1>
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('user') }}">ข้อมูลผู้ใช้งาน</a></li>
        <li class="active">แก้ไข</li>
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
            <input type="hidden" name="id" value="{{ $user->id }}">
            <table class="table table-bordered bs-table">

                <tr>
                    <td class="bs-center">{{ Form::label('name', 'ชื่อผู้ใช้งาน') }}</td>
                    <td>{{ Form::text('name', $user->name, ['class' => 'form-control']) }}</td>
                </tr>

                <tr>
                    <td class="bs-center">{{ Form::label('email', 'อีเมล์') }}</td>
                    <td>{{ Form::text('email', $user->email, ['class' => 'form-control']) }}</td>
                </tr>

                <tr>
                    <td class="bs-center">{{ Form::label('password', 'รหัสผ่าน') }}</td>
                    <td>{{ Form::password('password', ['class' => 'form-control']) }}</td>
                </tr>

            </table>

            <div class="panel-footer">
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
            </div>


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
