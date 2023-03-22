<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Author profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Author Information') }}
                            </h2>
                        </header>

                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $author->first_name)" disabled autofocus autocomplete="first_name" />
                        </div>

                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $author->last_name)" disabled autofocus autocomplete="last_name" />
                        </div>
                        <div>
                            <x-input-label for="birthday" :value="__('Birthday')" />
                            <x-text-input id="birthday" name="birthday" type="text" class="mt-1 block w-full" :value="old('birthday', $author->birthday)" disabled autofocus autocomplete="birthday" />
                        </div>
                        <div>
                            <x-input-label for="biography" :value="__('Biography')" />
                            <x-text-input id="biography" name="biography" type="text" class="mt-1 block w-full" :value="old('biography', $author->biography)" disabled autofocus autocomplete="biography" />
                        </div>
                        <div>
                            <x-input-label for="gender" :value="__('Gender')" />
                            <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full" :value="old('gender', $author->gender)" disabled autofocus autocomplete="gender" />
                        </div>
                        <div>
                            <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                            <x-text-input id="place_of_birth" name="place_of_birth" type="text" class="mt-1 block w-full" :value="old('place_of_birth', $author->place_of_birth)" disabled autofocus autocomplete="place_of_birth" />
                        </div>


                    </section>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Author Books') }}
                            </h2>
                        </header>
                        @isset($author->books)
                            <table class="border-collapse table-auto w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Id</th>
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Title</th>
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Release date</th>
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Isbn</th>
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Format</th>
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Number_of_pages</th>
                                        <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-slate-800">
                                    @foreach ($author->books as $book)
                                        <tr>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"><a href="/books/{{ $book->id }}"><u>{{ $book->id }}</u></a></td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ $book->title }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $book->release_date }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $book->isbn }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ $book->format }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">{{ $book->number_of_pages }}</td>
                                            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">
                                                <a class="bg-transparent hover:bg-green-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded block" href="/books-add">Create</a>
                                                <form method="POST" action="/books/{{$book->id}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <div class="form-group">
                                                        <input type="submit" class="bg-transparent hover:bg-red-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" value="Delete">
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
