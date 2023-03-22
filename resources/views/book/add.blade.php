<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Book Information') }}
                            </h2>
                            @if (session()->has('create_msg') && session()->get('create_msg') == 'Created fail!')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Create fail.') }}</p>
                            @endif
                            @if (session()->has('create_msg') && session()->get('create_msg') == 'Created')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Created.') }}</p>
                            @endif
                        </header>

                        <form method="post" action="{{ route('books.create') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="author_id" :value="__('Author')" />
                                <select class="form-control" id="author_id" name="author_id">
                                    @isset($authors->items)
                                        @foreach ($authors->items as $author)
                                            <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>

                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autofocus autocomplete="title" />
                            </div>

                            <div>
                                <x-input-label for="release_date" :value="__('Release date')" />
                                <x-text-input id="release_date" name="release_date" type="text" class="mt-1 block w-full" autofocus autocomplete="release_date" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" autofocus autocomplete="description" />
                            </div>
                            <div>
                                <x-input-label for="isbn" :value="__('Isbn')" />
                                <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" autofocus autocomplete="isbn" />
                            </div>
                            <div>
                                <x-input-label for="format" :value="__('Format')" />
                                <x-text-input id="format" name="format" type="text" class="mt-1 block w-full" autofocus autocomplete="format" />
                            </div>
                            <div>
                                <x-input-label for="number_of_pages" :value="__('Number of pages')" />
                                <x-text-input id="number_of_pages" name="number_of_pages" type="text" class="mt-1 block w-full" autofocus autocomplete="number_of_pages" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
