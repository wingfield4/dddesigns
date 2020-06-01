@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/admin.css">
@endsection

@section('content')
  <div class="page-container">
    <div class="inner-container">
      <x-admin-card title="Items">
        <ul>
          <li>There are {{ count($items) }} public item(s)</li>
          <li>
            <a href="/admin/items">
              View and edit items
            </a>
          </li>
          <li>
            <a href="/admin/items/add">
              Add a new item
            </a>
          </li>
        </ul>
      </x-admin-card>
      <x-admin-card title="Users">
        <ul>
          <li>
            <a href="/admin/users">There are {{ $userCount }} registered users</a>
          </li>
        </ul>
      </x-admin-card>
      <x-admin-card title="Orders">
        <ul>
          <li>
            <a href="/admin/orders?status=active">You have {{ $activeOrderCount }} active order(s)</a>
          </li>
          <li>
            <a href="/admin/orders?status=closed">You have {{ $closedOrderCount }} closed order(s)</a>
          </li>
        </ul>
      </x-admin-card>
    </div>
  </div>
@endsection
