<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles / Edit 
                        </h2>
            <a href="{{ route('article.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('article.update',$article->id) }}" method="post">
                    @csrf
                        <div>
                            <label for="" class="text-lg font-medium">Title</label>
                            <div class="my-3">
                            <input value="{{ old('title',$article->title) }}" name="title" placeholder="Enter title" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('title')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                            </div>

                            <label for="" class="text-lg font-medium">Content</label>
                            <div class="my-3">
                                <textarea  placeholder="content" class="border-gray-300 shadow-sm w-1/2 rounded-lg" name="text" id="text">{{ old('text',$article->text) }}</textarea>
                            @error('text')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                            </div>

                            <label for="" class="text-lg font-medium">Author</label>
                            <div class="my-3">
                            <input value="{{ old('author', $article->auther) }}" name="author" placeholder="Enter auther" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                            @error('author')
                                <p class="text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                            </div>

                            <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
