<?php

namespace App\Http\Controllers;

use App\Models\CarListing;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarListingController extends Controller
{
    public function index()
{
    $listings = CarListing::with(['carModel.make'])
        ->where('status', 'active')
        ->latest()
        ->paginate(9);

    return view('listings.index', compact('listings'));
}

    public function show(\App\Models\CarListing $listing)
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
        'make'        => ['required', 'string', 'max:255'],
        'model'       => ['required', 'string', 'max:255'],
        'title'       => ['required', 'string', 'max:255'],
        'year'        => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        'mileage'     => ['required', 'integer', 'min:0'],
        'fuel_type'   => ['required', 'in:petrol,diesel,hybrid,electric,other'],
        'transmission' => ['required', 'in:manual,automatic,semi-automatic,other'],
        'price'        => ['required', 'numeric', 'min:0'],
        'location'     => ['required', 'string', 'max:100'],
        'description'  => ['nullable', 'string', 'max:2000'],

    ]);

    $validated['status'] = 'available';

    $validated['user_id'] = auth()->id();

    $listing = \App\Models\CarListing::create($validated);

    return redirect()
        ->route('listings.show', $listing)
        ->with('success', 'Listing created successfully!');
}


}
