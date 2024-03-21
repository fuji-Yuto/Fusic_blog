<x-app-layout>
  

  
  @include('common.errors')
  <form action= "{{route('article.update',$article -> id)}}" method="POST" class="flex-row">
    @csrf
    @method('patch')
    <label for="title">タイトル</label>
    <input type="text" name="title" value="{{$article->title}}">
    <label for="content">記事内容</label>
    <textarea name="content" cols="30" rows="10" value="{{$article->content}}">{{$article->content}}</textarea>
    <input type="hidden" value="0" name="view">
    <button type ="subimit">更新</button>
  </form>
  <a href="{{route('dashboard')}}">Cancel</a>


</x-app-layout>