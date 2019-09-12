@extends('layouts.helloapp')

@section('title', 'Person.index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')
 <table>
   <tr> <th>Person</th><th>Board</th> </tr>
   @foreach ($items as $item)
    <tr>
      <td>{{$item->getData()}}</td>
      <td>
        // hasManyの場合、boardsみたいに複数形になることに気をつける
        @if ($item->boards != null)
        <table width="100%">
          @foreach($item->boards as $obj)
          <tr> <td>{{$obj->getData()}}</td> </tr>
          @endforeach
        </table>
        @endif
      </td>
    </tr>
   @endforeach
 </table>
@endsection

@section('footer')
copyright 2019 miyata.
@endsection
