@if ($paginator->hasPages())<!--ページネーションを表示すべきかの確認し、複数ページがある場合だけ次のコードを実行-->
<div class="paginationWrap">
    <ul class="pagination" role="navigation"><!--navigationはリンク先にページ遷移する-->
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())<!--現在のページが最初のページかどうか確認する-->
            <li  aria-disabled="true" aria-label="@lang('pagination.previous')"><!--最初のページにいる場合、「前へ」リンクが無効化される-->
                «
            </li>
        @else<!--現在のページが最初のページではない場合の処理-->
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">«</a><!--前のページがある場合、リンクを生成する-->
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)<!--ページリンクのすべての要素をループ処理する-->
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))<!--要素が文字列の場合そのまま表示-->
                <li aria-disabled="true">{{ $element }}</li><!--文字列要素をリスト項目として表示し、クリック不可にする-->
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))<!--$elementが配列かどうか確認する-->
                @foreach ($element as $page => $url)<!--配列の中身をループ処理し、$pageと$urlを取り出す-->
                    @if ($page == $paginator->currentPage())<!--現在のページ番号が$pageと一致しているか確認する-->
                        <li aria-current="page"><a class="active" href="#">{{ $page }}</a></li><!--現在のページであることを強調表示し、現在のページであることを示す。-->
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li><!--他のページのリンクを作成し、ページのURLを指定する-->
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">»</a><!--次のページのリンクを作成する-->
            </li>
        @else
            <li aria-disabled="true" aria-label="@lang('pagination.next')"><!--次のページがない場合、「次へ」のリンクを無効化して表示する-->
            »
            </li>
        @endif
    </ul>
</div>
@endif