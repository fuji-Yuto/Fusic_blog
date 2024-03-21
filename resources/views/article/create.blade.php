<!-- resources/views/tweet/create.blade.php -->

<x-app-layout>
  
  
  @include('common.errors')
  <form action= "{{route('article.store')}}" method="POST" class="flex-row">
    @csrf
    <label for="title">タイトル</label>
    <input type="text" name="title" >
    <label for="content">記事内容</label>
    <textarea name="content" cols="30" rows="10"></textarea>
    <input type="hidden" value="0" name="view">
    <button type ="subimit">投稿</button>
  </form>
  <a href="{{route('dashboard')}}">Cancel</a>
</x-app-layout>

