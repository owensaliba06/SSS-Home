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

        @auth
            @if (auth()->id() === $listing->user_id)
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
            @endif
        @endauth
    </div>
</div>
