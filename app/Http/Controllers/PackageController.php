<?php

namespace App\Http\Controllers;

use Storage;
use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use App\DataTables\PackageDataTable;
use App\Models\Package; // Import the Package model
use App\Models\Slot; // Import the Slot model
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the packages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PackageDataTable $dataTable)
    {
        $pageTitle = trans('packages.title');  // Directly using 'packages.title' to get 'Package List'
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="' . route('packages.create') . '" class="btn btn-sm btn-primary" role="button">Add Package</a>';

        return $dataTable->render('global.datatable', compact('pageTitle', 'auth_user', 'assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new package.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the view for creating a new package with default values
        return view('Admin.package.create', [
            'packageImage' => asset('images/default-package.png') // Default image for create view
        ]);
    }

    /**
     * Store a newly created package in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer', // Adjust if necessary
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'slots.*.slot_number' => 'required|integer',
            'slots.*.available_slots' => 'required|integer',
            'slots.*.price' => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Handle package image upload
            $imagePath = null;
            if ($request->hasFile('package_image')) {
                $imagePath = $request->file('package_image')->store('public/packages');
            }

            // Create a new package in the database
            $package = Package::create(array_merge($request->all(), ['package_image' => $imagePath]));

            // Handle the slots
            if ($request->has('slots')) {
                foreach ($request->input('slots') as $slotData) {
                    $slot = new Slot();
                    $slot->slot_number = $slotData['slot_number'];
                    $slot->available_slots = $slotData['available_slots'];
                    $slot->price = $slotData['price'];
                    $slot->package_id = $package->id;
                    $slot->save();
                }
            }

            DB::commit();

            // Redirect to the packages index with a success message
            return redirect()->route('packages.index')->with('success', 'Package created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to create package: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified package.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the package by its ID
        $package = Package::findOrFail($id);


        // Return the view with the package details
        return view('Admin.package.show', compact('id', 'package'));
    }

    /**
     * Show the form for editing the specified package.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the package by its ID
        $package = Package::findOrFail($id);

        // Return the view for editing the package with existing data
        return view('Admin.package.edit', [
            'package' => $package,
            'packageImage' => $package->package_image ? asset('storage/' . $package->package_image) : asset('images/default-package.png')
        ]);
    }

    /**
     * Update the specified package in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'nullable|integer',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'slots.*.slot_number' => 'required|integer',
            'slots.*.available_slots' => 'required|integer',
            'slots.*.price' => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Find the package by its ID
            $package = Package::findOrFail($id);

            // Handle package image upload
            if ($request->hasFile('package_image')) {
                // Delete old image if exists
                if ($package->package_image) {
                    Storage::delete($package->package_image);
                }

                $imagePath = $request->file('package_image')->store('public/packages');
                $validatedData['package_image'] = $imagePath;
            }

            // Update the package details
            $package->update($validatedData);

            // Handle slots
            if ($request->has('slots')) {
                // Delete existing slots
                Slot::where('package_id', $package->id)->delete();

                // Create new slots
                foreach ($request->input('slots') as $slotData) {
                    $slot = new Slot();
                    $slot->fill($slotData);
                    $slot->package_id = $package->id;
                    $slot->save();
                }
            }

            DB::commit();

            return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update package: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified package from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the package by its ID and delete it
        $package = Package::findOrFail($id);

        // Delete the image if exists
        if ($package->package_image) {
            Storage::delete($package->package_image);
        }

        $package->delete();

        // Redirect to the packages index with a success message
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }

    /**
     * Add a slot to the specified package.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $packageId
     * @return \Illuminate\Http\Response
     */
    public function addSlot(Request $request, $packageId)
    {
        $request->validate([
            'slot_number' => 'required|integer',
            'available_slots' => 'required|integer',
            'price' => 'nullable|numeric',
        ]);

        $package = Package::findOrFail($packageId);
        $package->slots()->create($request->all());

        return redirect()->route('packages.show', $packageId)->with('success', 'Slot added successfully.');
    }


 
}
