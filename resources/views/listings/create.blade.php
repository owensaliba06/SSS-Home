<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Listing
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                <form method="POST" action="{{ route('listings.store') }}">
                    @csrf

                    {{-- MAKE (first) --}}
                    <div class="mb-4">
                        <label class="block font-medium">Make</label>
                        <input
                            name="make"
                            value="{{ old('make') }}"
                            class="w-full border rounded p-2"
                            placeholder="e.g. Honda"
                        />
                        @error('make')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- MODEL (second) --}}
                    <div class="mb-4">
                        <label class="block font-medium">Model</label>
                        <input
                            name="model"
                            value="{{ old('model') }}"
                            class="w-full border rounded p-2"
                            placeholder="e.g. Civic"
                        />
                        @error('model')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TITLE --}}
                    <div class="mb-4">
                        <label class="block font-medium">Title</label>
                        <input
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full border rounded p-2"
                            placeholder="e.g. Honda Civic 2010 for sale"
                        />
                        @error('title')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- YEAR --}}
                        <div class="mb-4">
                            <label class="block font-medium">Year</label>
                            <input
                                name="year"
                                value="{{ old('year') }}"
                                class="w-full border rounded p-2"
                                placeholder="e.g. 2010"
                            />
                            @error('year')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- MILEAGE --}}
                        <div class="mb-4">
                            <label class="block font-medium">Mileage (km)</label>
                            <input
                                name="mileage"
                                value="{{ old('mileage') }}"
                                class="w-full border rounded p-2"
                                placeholder="e.g. 120000"
                            />
                            @error('mileage')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- FUEL TYPE --}}
                        <div class="mb-4">
                            <label class="block font-medium">Fuel Type</label>
                            <select name="fuel_type" class="w-full border rounded p-2">
                                @php $fuel = old('fuel_type', 'petrol'); @endphp
                                <option value="petrol"  {{ $fuel === 'petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="diesel"  {{ $fuel === 'diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="hybrid"  {{ $fuel === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="electric"{{ $fuel === 'electric' ? 'selected' : '' }}>Electric</option>
                                <option value="other"   {{ $fuel === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('fuel_type')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- TRANSMISSION --}}
                        <div class="mb-4">
                            <label class="block font-medium">Transmission</label>
                            <select name="transmission" class="w-full border rounded p-2">
                                @php $tr = old('transmission', 'manual'); @endphp
                                <option value="manual"          {{ $tr === 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="automatic"       {{ $tr === 'automatic' ? 'selected' : '' }}>Automatic</option>
                                <option value="other"           {{ $tr === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('transmission')
                                <div class="text-red-600 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- PRICE --}}
                    <div class="mb-4">
                        <label class="block font-medium">Price (€)</label>
                        <input
                            name="price"
                            value="{{ old('price') }}"
                            class="w-full border rounded p-2"
                            placeholder="e.g. 7500"
                        />
                        @error('price')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- LOCATION --}}
                    <div class="mb-4">
                        <label class="block font-medium">Location</label>
                        <input
                            name="location"
                            value="{{ old('location') }}"
                            class="w-full border rounded p-2"
                            placeholder="e.g. Zebbug"
                        />
                        @error('location')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-6">
                        <label class="block font-medium">Description</label>
                        <textarea
                            name="description"
                            class="w-full border rounded p-2"
                            rows="4"
                            placeholder="Optional details..."
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- STATUS REMOVED ON CREATE. Controller forces available. --}}

                    <div class="flex gap-3">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save
                        </button>

                        <a href="{{ route('listings.index') }}" class="px-4 py-2 bg-gray-200 rounded">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
