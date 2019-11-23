@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Browse</div>

                <div class="card-body">
                    <div class="pager-top">{{ $purchases->links() }}</div>
                    <table id="browse" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td>{{ $purchase->price }}</td>
                                <td>{{ $purchase->description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pager-btm">{{ $purchases->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
