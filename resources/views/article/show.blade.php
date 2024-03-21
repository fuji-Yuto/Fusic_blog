<x-app-layout>

    <div class="bg-white w-3/5 mb-5 mt-3 text-center">
        <p class="text-xl">
            {{$article->id}}
        </p>
        <p >
            {{$article->content}}
        </p>
        <p>
            view:{{$article->view}}
        </p>
        <p class="text-sm">
            作成日:{{$article->created_at}}
        </p>
    </div>

</x-app-layout>