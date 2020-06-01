@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - Users')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')
  <div class="page-container">
    <h1>Users</h1>

    @if (count($users) > 0)
      <table class="pure-table pure-table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Registered At</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{ $user->first_name}} {{ $user->last_name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ is_null($user->created_at) ? '' : date_format($user->created_at, 'M d, Y h:ia') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <x-pagination
        :totalCount="$usersCount"
        :page="$page"
        :pageSize="$pageSize"
        baseUrl="/admin/users"
      />
    @else
      <h2>No Users Found!</h2>
    @endif
  </div>
@endsection
