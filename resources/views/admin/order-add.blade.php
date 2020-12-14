@extends('./layouts/admin')

@section('content')
    <div class="container">
        <br/>
        <br/>
        <h2 align="center">Order</h2>
        <div class="form-group">
            <form action="{{route('admin.order.add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 mb-2">
                    <div class="col-4">
                        <label for="">Waiter</label>
                        <select name="waiter_id" class="form-control">
                            @foreach($employee as $item)
                                <option value="{{$item['id_karyawan']}}">{{$item['Nama']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="">Customer</label>
                        <select name="customer_id" class="form-control">
                            @foreach($customer as $item)
                                <option value="{{$item['name']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-8 ">
                        <label for="">Menu</label>
                        <select name="menu_id" class="form-control">
                            @foreach($menu as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                    </div>
                </div>
        <input type="submit" name="submit" id="submit" class="btn btn-primary mt-5" value="Submit"/>
        </form>
    </div>
    </div>
    @push('script')
    @endpush
@endsection
