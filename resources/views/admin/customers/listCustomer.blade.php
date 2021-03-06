@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Người dùng
                    <small>Danh sách</small>
                </h1>
                @if(Session::has('invalid'))
                <div class="alert alert-danger alert-dismissible">
                     <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{Session::get('invalid')}}
                </div>
                @endif
                @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('success')}}
                        </div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>#</th>
                        <th>Tài khoản người dùng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Giới tính</th>
                        <th>Ngày đăng ký</th>
                        <th>Trạng thái</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $customer['username'] }}</td>
                                <td>{{ $customer['email'] }}</td>
                                <td>{{ $customer['phone'] }}</td>
                                <td>{{ $customer['sex'] }}</td>
                                <td>{{ date('d-m-Y',strtotime($customer['created_at'])) }}</td>
                                <td>{{ $customer['status'] === 1 ? "Hoạt động":"Không hoạt động" }}</td>
                                <td>
                                    <a href="{{ route('customer.delete',['id'=>$customer['id']]) }}" onclick="return confirm('Bạn có muốn xóa khách hàng này ?');"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    <a href="{{ route('customer.disable',['id'=>$customer['id']]) }}" style="margin-right:1rem;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                    <a href="{{ route('customer.enable',['id'=>$customer['id']]) }}"><i class="fa fa-check-square" aria-hidden="true"></i>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection