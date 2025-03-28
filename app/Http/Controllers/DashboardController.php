<?php

namespace App\Http\Controllers;

use App\Models\projects;
use Flowframe\Trend\Trend;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index()
    {
         $projectcount = Trend::model(projects::class)
         ->between(
             start: now(),
             end: now()->endOfMonth(),
         )
         ->perMonth()
         ->count();

        return view("admin.dashboard",compact('projectcount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
