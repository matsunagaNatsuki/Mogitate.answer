@if ($paginator->hasPages())<!--ページ数が複数ある時、ページネーションを表示-->
<nav>
    <ul class="pagination"><!--ページネーションをリスト形式で表示-->
        {{-- Previous Page Link --}}<!--前のページのリンク部分-->
        @if ($paginator->onFirstPage())<!--現在のページが最初のページの場合-->
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"><!--「前へ」というラベルを設定し、このリンクは無効である-->
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else<!--現在のページが最初のページででない場合-->
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                <!--前のページのリンクURLを取得。このページが「前のページ」へのものであることを示す-->
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)<!--すべてのページネーション要素をループで処理する-->
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))<!--$elementが文字列である場合に処理する-->
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $elements }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item-active" aria-current="page"><span class="page-link-active">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>
@endif
