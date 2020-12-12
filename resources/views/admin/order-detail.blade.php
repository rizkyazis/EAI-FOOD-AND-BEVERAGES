@extends('./layouts/admin')

@section('content')
    <div class="container">
        <br/>
        <br/>
        <h2 align="center">Detail Order</h2>
        <h3>Order #{{$order->id}}</h3>
        <div class="row">
            <div class="col-4">
                Customer Name
            </div>
            <div class="col-8">
                : {{$order->customer_id}}
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                Waiter NIK
            </div>
            <div class="col-8">
                : {{$order->waiter_id}}
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                Status
            </div>
            <div class="col-8">
                : {{$order->status}}
            </div>
        </div>
        <h5 class="mt-5">Menu Order</h5>
        <table class="table w-50">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Menu</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->menu as $index=>$item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$item->menu->name}}</td>
                    <td>
                        <form action="{{route('admin.delete.menu.order',$item->id)}}" method="post">
                            @csrf
                            <a data-toggle="modal" data-target="#modal{{$item->id}}" class="btn btn-sm btn-primary">Update</a>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <div class="modal fade" id="modal{{$item->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$item->menu->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.update.menu.order',$item->id)}}" method="post">
                                    @csrf
                                    <label for="">Chef</label>
                                    <select name="chef_id" class="form-control" >
                                        @foreach($employee as $emp)
                                            <option value="{{$emp['id_karyawan']}}" @if($emp['id_karyawan'] === $item->chef_id) selected @endif>{{$emp['Nama']}}</option>
                                        @endforeach
                                    </select>
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" >
                                        <option value="Finish" @if('Finish' === $item->status) selected @endif>Finish</option>
                                        <option value="Waiting"@if('Waiting' === $item->status) selected @endif>Waiting</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('script')
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
@endpush
