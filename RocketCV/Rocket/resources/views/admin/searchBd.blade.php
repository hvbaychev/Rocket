@extends('admin.layouts.app', ['page' => __('Users Management'), 'pageSlug' => 'profile'])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.cv_by_period') }}" method="get">
                    <form id="searchForm">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>

                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required>

                    <button type="submit" id="searchButton">Search</button>
                </form>
                    </form>

                    <div class="">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Birthday</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                @if(isset($cvList))
                                @foreach ($cvList as $cv)
                                <tr>
                                    <td>{{ $cv->first_name }} {{ $cv->middle_name }} {{ $cv->last_name }}</td>
                                    <td>{{ $cv->birth_date }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
