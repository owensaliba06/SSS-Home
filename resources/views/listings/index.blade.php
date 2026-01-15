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

            <div class="mb-4 flex items-center justify-between gap-3">
                <a href="{{ route('listings.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded">
                    Create Listing
                </a>

                {{-- Reset filters --}}
                <a href="{{ route('listings.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded">
                    Reset
                </a>
            </div>

            {{-- FILTER + SORT FORM --}}
            <div class="bg-white shadow sm:rounded-lg p-4 mb-4">
                <form method="GET" action="{{ route('listings.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Make</label>
                            <input type="text"
                                   name="make"
                                   value="{{ request('make') }}"
                                   class="mt-1 w-full border rounded p-2"
                                   placeholder="e.g. Honda">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Model</label>
                            <input type="text"
                                   name="model"
                                   value="{{ request('model') }}"
                                   class="mt-1 w-full border rounded p-2"
                                   placeholder="e.g. Civic">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text"
                                   name="location"
                                   value="{{ request('location') }}"
                                   class="mt-1 w-full border rounded p-2"
                                   placeholder="e.g. Zebbug">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fuel Type</label>
                            @php $fuel = request('fuel_type'); @endphp
                            <select name="fuel_type" class="mt-1 w-full border rounded p-2">
                                <option value="">Any</option>
                                <option value="petrol"   @selected($fuel === 'petrol')>Petrol</option>
                                <option value="diesel"   @selected($fuel === 'diesel')>Diesel</option>
                                <option value="hybrid"   @selected($fuel === 'hybrid')>Hybrid</option>
                                <option value="electric" @selected($fuel === 'electric')>Electric</option>
                                <option value="other"    @selected($fuel === 'other')>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Transmission</label>
                            @php $tr = request('transmission'); @endphp
                            <select name="transmission" class="mt-1 w-full border rounded p-2">
                                <option value="">Any</option>
                                <option value="manual"    @selected($tr === 'manual')>Manual</option>
                                <option value="automatic" @selected($tr === 'automatic')>Automatic</option>
                                <option value="other"     @selected($tr === 'other')>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Min Year</label>
                            <input type="number"
                                   name="min_year"
                                   value="{{ request('min_year') }}"
                                   class="mt-1 w-full border rounded p-2"
                                   placeholder="e.g. 2005">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Max Year</label>
                            <input type="number"
                                   name="max_year"
                                   value="{{ request('max_year') }}"
                                   class="mt-1 w-full border rounded p-2"
                                   placeholder="e.g. 2018">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sort</label>
                            @php $sort = request('sort', 'newest'); @endphp
                            <select name="sort" class="mt-1 w-full border rounded p-2">
                                <option value="newest"      @selected($sort === 'newest')>Newest</option>
                                <option value="price_asc"   @selected($sort === 'price_asc')>Price (Low → High)</option>
                                <option value="price_desc"  @selected($sort === 'price_desc')>Price (High → Low)</option>
                                <option value="year_asc"    @selected($sort === 'year_asc')>Year (Old → New)</option>
                                <option value="year_desc"   @selected($sort === 'year_desc')>Year (New → Old)</option>
                                <option value="mileage_asc" @selected($sort === 'mileage_asc')>Mileage (Low → High)</option>
                                <option value="mileage_desc"@selected($sort === 'mileage_desc')>Mileage (High → Low)</option>
                            </select>
                        </div>

                        <div class="lg:col-span-4 flex gap-2 mt-2">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                                Apply
                            </button>
                            <a href="{{ route('listings.index') }}" class="px-4 py-2 bg-gray-200 rounded">
                                Clear
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-4">
                @if ($listings->count() === 0)
                    <div class="text-gray-600">No listings yet.</div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($listings as $listing)
                        @include('listings._card', ['listing' => $listing])
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
