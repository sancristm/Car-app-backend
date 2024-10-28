<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all cars
        $cars = Car::all();
       return response()->json($cars, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'car_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'availability_status' => 'boolean'
        ]);

        // Create a new car
        $car = Car::create($validatedData);

        return response()->json($car, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the car by ID or return 404 if not found
        $car = Car::find($id);
        
        if (!$car) {
            return response()->json(['error' => 'Car not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($car, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the car by ID or return 404 if not found
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['error' => 'Car not found'], Response::HTTP_NOT_FOUND);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'car_name' => 'sometimes|required|string|max:255',
            'model' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'availability_status' => 'boolean'
        ]);

        // Update the car with validated data
        $car->update($validatedData);

        return response()->json($car, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the car by ID or return 404 if not found
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['error' => 'Car not found'], Response::HTTP_NOT_FOUND);
        }

        // Delete the car
        $car->delete();

        return response()->json(['message' => 'Car deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
