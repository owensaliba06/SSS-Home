<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-6">
        <a href="{{ route('listings.index') }}" class="text-blue-600 hover:underline">← Back to listings</a>

        <div class="bg-white shadow sm:rounded-lg p-6 mt-4">
            <h1 class="text-2xl font-semibold">{{ $listing->title }}</h1>

            <p class="text-gray-600 mt-2">
                {{ $listing->make }} {{ $listing->model }} •
                {{ $listing->year }} •
                {{ number_format($listing->mileage) }} km
            </p>

            <div class="text-2xl font-bold mt-4">
                €{{ number_format($listing->price, 0) }}
            </div>

            <div class="mt-4 space-y-2">
                <p><strong>Fuel:</strong> {{ ucfirst($listing->fuel_type) }}</p>
                <p><strong>Transmission:</strong> {{ ucfirst($listing->transmission) }}</p>
                <p><strong>Location:</strong> {{ $listing->location }}</p>
                <p><strong>Status:</strong> {{ ucfirst($listing->status) }}</p>
            </div>

            @if($listing->description)
                <hr class="my-4">
                <p>{{ $listing->description }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
