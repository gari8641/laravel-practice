@extends('layouts.helloapp')

@section('title','Index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')

<table>
  <tr>
    <th><Name></th> <th>Mail</th> <th>Age</th>
  </tr>
  @foreach
    <tr>
      <td>{{$item->name}}</td>
      <td>{{$item->Mail}}</td>
      <td>{{$item->Age}}</td>
    </tr>
  @endforeach
</table>

@endsection

@section('footer')
copyright 2019 miyata.
@endsection
