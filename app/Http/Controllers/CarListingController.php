<?php

namespace App\Http\Controllers;

use App\Models\CarListing;
use Illuminate\Http\Request;

class CarListingController extends Controller
{
    public function index(Request $request)
    {
        $query = CarListing::query()->with(['carModel.make']);

        $query->where('status', 'available');

        // Filtering
        if ($request->filled('make')) {
            $query->where('make', 'like', '%' . trim($request->input('make')) . '%');
        }

        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . trim($request->input('model')) . '%');
        }

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->input('fuel_type'));
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->input('transmission'));
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . trim($request->input('location')) . '%');
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'year_asc':
                $query->orderBy('year', 'asc');
                break;
            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $listings = $query->paginate(9)->appends($request->query());

        return view('listings.index', compact('listings'));
    }

    public function show(CarListing $listing)
    {
        $listing->load('carModel.make');

        return view('listings.show', compact('listing'));
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'make'         => ['required', 'string', 'max:255'],
            'model'        => ['required', 'string', 'max:255'],
            'title'        => ['required', 'string', 'max:255'],
            'year'         => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'mileage'      => ['nullable', 'integer', 'min:0'],
            'fuel_type'    => ['required', 'in:petrol,diesel,hybrid,electric,other'],

            'transmission' => ['required', 'in:manual,automatic,other'],

            'price'        => ['required', 'integer', 'min:0'],
            'location'     => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:2000'],
        ]);

        $validated['status'] = 'available';
        $validated['user_id'] = auth()->id();

        // car_model_id is optional now
        $validated['car_model_id'] = null;

        // slug will be generated in the model booted() hook
        $listing = CarListing::create($validated);

        return redirect()
            ->route('listings.show', $listing)
            ->with('success', 'Listing created successfully!');
    }

    public function edit(CarListing $listing)
    {
        $this->authorizeOwner($listing);

        return view('listings.edit', compact('listing'));
    }

    public function update(Request $request, CarListing $listing)
    {
        $this->authorizeOwner($listing);

        $validated = $request->validate([
            'make'         => ['required', 'string', 'max:255'],
            'model'        => ['required', 'string', 'max:255'],
            'title'        => ['required', 'string', 'max:255'],
            'year'         => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'mileage'      => ['nullable', 'integer', 'min:0'],
            'fuel_type'    => ['required', 'in:petrol,diesel,hybrid,electric,other'],
            'transmission' => ['required', 'in:manual,automatic,other'],
            'price'        => ['required', 'integer', 'min:0'],
            'location'     => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:2000'],
            'status'       => ['required', 'in:available,sold'],
        ]);

        $listing->update($validated);

        return redirect()
            ->route('listings.show', $listing) 
            ->with('success', 'Listing updated successfully!');
    }

    public function destroy(CarListing $listing)
    {
        $this->authorizeOwner($listing);

        $listing->delete();

        return redirect()
            ->route('listings.index')
            ->with('success', 'Listing deleted successfully!');
    }

    private function authorizeOwner(CarListing $listing): void
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
