<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Car Listings
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('listings.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded">
                    Create Listing
                </a>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-4">
                @if ($listings->count() === 0)
                    <div class="text-gray-600">No listings yet.</div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($listings as $listing)
                            <div class="border rounded p-4 hover:bg-gray-50">

                                <div class="font-semibold text-lg">
                                    {{ $listing->make }} {{ $listing->model }}
                                </div>

                                <div class="text-gray-700">
                                    {{ $listing->title }}
                                </div>

                                <div class="text-sm text-gray-600 mt-2">
                                    Year: {{ $listing->year }} |
                                    Price: €{{ number_format($listing->price) }}
                                </div>

                                <div class="text-sm mt-2">
                                    <span class="px-2 py-1 rounded bg-gray-100">
                                        Status: {{ $listing->status }}
                                    </span>
                                </div>

                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('listings.show', $listing) }}"
                                       class="px-3 py-2 bg-gray-800 text-white rounded text-sm">
                                        View
                                    </a>

                                    <a href="{{ route('listings.edit', $listing) }}"
                                       class="px-3 py-2 bg-blue-600 text-white rounded text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('listings.destroy', $listing) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this listing?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-2 bg-red-600 text-white rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $listings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
