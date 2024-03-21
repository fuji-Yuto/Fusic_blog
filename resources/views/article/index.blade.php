@php
  $CurrentUserData = Auth::user();
@endphp
<x-app-layout>
  
  <form action="{{route('article.index')}}"  method="GET">
    <select name="sort_type">
      <option value="newest" selected>新しい順</option>
      <option value="oldest" >古い順</option>
      <option value="most_viewed" >閲覧数順</option>
    </select>
    <button type = subimit>送信</button>
  </form>
  

  @foreach($articles as $article)
    <div class="bg-white w-3/5 mb-5 mt-3 text-center">
        <a href="{{ route('article.show',$article -> id) }}" class="text-xl">
          {{$article -> title}}
        </a>
        <p class="text-sm">
          投稿者:{{ $article -> user -> name }}
        </p>
        <p class="text-sm">
          更新日:{{ $article -> updated_at }}
        </p>
        <p class="text-sm">
          閲覧数:{{ $article -> view }}
        </p>
        @if( $CurrentUserData -> id === $article -> user_id )
        <a href="{{ route('article.edit',$article -> id) }}" >
          <p>編集</p>
        </a>
        <form action="{{route('article.destroy',$article->id)}}" method="POST">
          @method('delete')
          @csrf
          <button>削除</button>
        </form>
        @endif
    </div>
  @endforeach

</x-app-layout>