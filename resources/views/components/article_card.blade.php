{{-- resources/views/components/article-card.blade.php --}}
<div class="bg-white w-3/5 mb-5 mt-3 text-center">
    <a href="{{ route('article.show',$article->id) }}" class="text-xl">
        {{$article->title}}
    </a>
    <p class="text-sm">
        投稿者:{{$article->user->name}}
    </p>
    <p class="text-sm">
        更新日:{{$article->updated_at}}
    </p>
    <p class="text-sm">
        閲覧数:{{$article->view}}
    </p>

    @if($article->good_users()->where('user_id', Auth::id())->exists() )
    <form action="{{route('not_good',$article)}}" method = "post">
        @csrf
        <button>
            <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button> 
        {{$article->good_users()->count()}}
    </form>
    @else
    <form action="{{route('good',$article)}}" method = "post">
      @csrf
        <button>
            <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="gray">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
        {{$article->good_users()->count()}}
    </form>
    @endif

     <!-- ログインしているユーザーのみ編集可能 -->
    @if( Auth::user()->id === $article->user_id )
    <a href="{{ route('article.edit',$article->id) }}" >
        <p>編集</p>
    </a>
    <form action="{{route('article.destroy',$article->id)}}" method="POST">
        @method('delete')
        @csrf
        <button>削除</button>
    </form>
    @endif
</div>
