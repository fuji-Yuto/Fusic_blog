<x-app-layout>

  <form action="{{route('article.index')}}"  method="GET">
    @component('components.sorting_select', ['sortType' => request()->input('sort_type', 'newest')])
    @endcomponent
    <button type="submit">送信</button>
  </form>
  @foreach($articles as $article)
    @component('components.article_card', ['article' => $article])
    @endcomponent
  @endforeach

</x-app-layout>