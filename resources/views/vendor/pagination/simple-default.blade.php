<?php
// $paginatorっつー変数はpaginateやsimplePaginateで返されたインスタンス
// このサンプルでは渡される前の変数名は$itemsになってるけど、自動で$paginatorとして渡される。
//
// # メソッドや値の種類
// $paginator->hasPage()  ... 複数のページがあるか true|false
// $paginator->onFirstPage()  ... 最初のページを表示しているか true|false
// @lang('pagination.previous') ... 国際化対応のリソースからpagination.previousという名前の値を取り出す
// $paginator->hasMorePage()  ... 現在のページより先にページがあるか true|false
// $paginator->previousPageUrl()  ... 前のページのURLを返す
//
// $paginator->currentPage()  ... 現在開いているページ番号を返す
// $paginator->count()  ... ページに表示されているレコード数を返す
// $paginator->nextPageUrl()  ... 次のページのURLを返す
// $paginator->url(番号)  ... 引数に指定したページ番号のURLを返す
//
//
?>
@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
