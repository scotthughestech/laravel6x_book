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
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td>{{ $purchase->price }}</td>
                                <td>{{ $purchase->description }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="/edit/{{ $purchase->id }}">Edit</a>
                                </td>
                                <td>
                                    <form method="POST" action="/delete/{{ $purchase->id }}" onsubmit="confirmDelete(event)">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
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

@section('scripts')
<script>
    function confirmDelete(event)
    {
        // Prevent the form from submitting automatically
        event.preventDefault();

        // Confirm they really want to delete this purchase
        if (confirm('Do you really want to delete this purchase?')) {
            // Submit the form
            event.target.submit();
        }
    }
</script>
@endsection
