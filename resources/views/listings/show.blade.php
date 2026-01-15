<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-6">
        <a href="{{ route('listings.index') }}" class="text-blue-600 hover:underline">← Back to listings</a>

        @if (session('success'))
            <div class="mt-4 p-3 bg-green-100 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow sm:rounded-lg p-6 mt-4">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold">{{ $listing->title }}</h1>

                    <p class="text-gray-600 mt-2">
                        {{ $listing->make }} {{ $listing->model }} •
                        {{ $listing->year }} •
                        {{ number_format($listing->mileage) }} km
                    </p>
                </div>

                {{-- Owner-only actions --}}
                @auth
                    @if (auth()->id() === $listing->user_id)
                        <div class="flex gap-2">
                            <a href="{{ route('listings.edit', $listing) }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded">
                                Edit
                            </a>

                            <form action="{{ route('listings.destroy', $listing) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this listing?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="text-2xl font-bold mt-4">
                €{{ number_format($listing->price, 0) }}
            </div>

            <div class="mt-4 space-y-2">
                <p><strong>Fuel:</strong> {{ ucfirst($listing->fuel_type) }}</p>
                <p><strong>Transmission:</strong> {{ ucfirst($listing->transmission) }}</p>
                <p><strong>Location:</strong> {{ $listing->location }}</p>
                <p><strong>Status:</strong> {{ ucfirst($listing->status) }}</p>
            </div>

            @if ($listing->description)
                <hr class="my-4">
                <p>{{ $listing->description }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
