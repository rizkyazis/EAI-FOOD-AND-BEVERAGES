@extends('./layouts/admin')

@section('content')
    <div class="container">
        <h2 align="center">Order</h2>
        <a href="{{route('admin.order.add.index')}}" class="btn btn-success">Add Order</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer</th>
                <th scope="col">NIK Waiter</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $index=>$item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->customer_id}}</td>
                        <td>{{$item->waiter_id}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <form action="{{route('admin.delete.order',$item->id)}}" method="post">
                                @csrf
                                <a href="{{route('admin.detail.order',$item->id)}}" class="btn btn-sm btn-primary">Detail</a>
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
