<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Listing
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('listings.show', $listing) }}" class="text-blue-600 hover:underline">
                ← Back to listing
            </a>

            <div class="bg-white shadow sm:rounded-lg p-6 mt-4">

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 border border-red-300 rounded">
                        <div class="font-semibold mb-2">Please fix the following:</div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('listings.update', $listing) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Make</label>
                            <input type="text"
                                   name="make"
                                   value="{{ old('make', $listing->make) }}"
                                   class="mt-1 w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Model</label>
                            <input type="text"
                                   name="model"
                                   value="{{ old('model', $listing->model) }}"
                                   class="mt-1 w-full border rounded px-3 py-2">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text"
                                   name="title"
                                   value="{{ old('title', $listing->title) }}"
                                   class="mt-1 w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Year</label>
                            <input type="number"
                                   name="year"
                                   value="{{ old('year', $listing->year) }}"
                                   class="mt-1 w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mileage (km)</label>
                            <input type="number"
                                   name="mileage"
                                   value="{{ old('mileage', $listing->mileage) }}"
                                   class="mt-1 w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fuel Type</label>
                            <select name="fuel_type" class="mt-1 w-full border rounded px-3 py-2">
                                @php $fuel = old('fuel_type', $listing->fuel_type); @endphp
                                <option value="petrol"   @selected($fuel === 'petrol')>Petrol</option>
                                <option value="diesel"   @selected($fuel === 'diesel')>Diesel</option>
                                <option value="hybrid"   @selected($fuel === 'hybrid')>Hybrid</option>
                                <option value="electric" @selected($fuel === 'electric')>Electric</option>
                                <option value="other"    @selected($fuel === 'other')>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Transmission</label>
                            <select name="transmission" class="mt-1 w-full border rounded px-3 py-2">
                                @php $trans = old('transmission', $listing->transmission); @endphp
                                <option value="manual"    @selected($trans === 'manual')>Manual</option>
                                <option value="automatic" @selected($trans === 'automatic')>Automatic</option>
                                <option value="other"     @selected($trans === 'other')>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price (€)</label>
                            <input type="number"
                                   name="price"
                                   value="{{ old('price', $listing->price) }}"
                                   class="mt-1 w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text"
                                   name="location"
                                   value="{{ old('location', $listing->location) }}"
                                   class="mt-1 w-full border rounded px-3 py-2">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description"
                                      rows="4"
                                      class="mt-1 w-full border rounded px-3 py-2">{{ old('description', $listing->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            @php $status = old('status', $listing->status); @endphp
                            <select name="status" class="mt-1 w-full border rounded px-3 py-2">
                                <option value="available" @selected($status === 'available')>Available</option>
                                <option value="sold"      @selected($status === 'sold')>Sold</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save Changes
                        </button>

                        <a href="{{ route('listings.show', $listing) }}"
                           class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
