@extends('layouts.helloapp')

@section('title', 'Session')

@section('menubar')
  @parent
  セッションページ
@endsection

@section('content')
  <p>{{$session_data}}</p>
  <!-- /hello を hello と記述してたせいで/hello/hello/session に送られちゃってた。 -->
  <form action="/hello/session" method="post">
    {{ csrf_field() }}
    <input type="text" name="input">
    <input type="submit" value="send">
  </form>
@endsection

@section('footer')
copyright xxx
@endsection
