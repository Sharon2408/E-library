@extends('layouts.app')
@section('title')
     View Plans
@endsection

@section('content')

<div class="container p-3 table-responsive">
        <div class="row">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary mb-2" href="/admin/createplan">Add Plans</a>
                </div>
            <div class="col-lg col-sm-12">
                <table class="table table-striped table-hover">
                    <thead class="text-center font-weight-bold">
                        <tr>
                            <td scope="col">Plan</td>
                            <td scope="col">Price</td>
                            <td scope="col">Duration</td>
                            <td scope="col" colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            <tr class="text-center">
                                <td>{{ $plan->plan_name }}</td>
                                <td>{{ $plan->price }}</td>
                                <td>{{ $plan->plan_duration }}</td>
                                <td class="text-center"><a class="btn btn-info float-end"
                                        href="/admin/{{ $plan->id }}/editplan">Edit</a></td>
                                <td class="text-center">
                                    <form action="/plan/{{ $plan->id }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger float-start" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div> --}}
    </div>
@endsection