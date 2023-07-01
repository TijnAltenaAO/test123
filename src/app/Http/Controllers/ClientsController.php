<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $clients = User::all();
        return view('clients.index', compact('clients'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('clients.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request['password'] = "test12435";

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $clients = User::create($data);
        return redirect()->route('index')->with('success', 'Clients created successfully');
    }

    // Display the specified resource
    public function show($id)
    {
        $clients = User::getClients($id);
        return view('clients.show', compact('clients'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        var_dump("test");exit;
        $clients = User::getClients($id);
        return view('clients.edit', compact('clients'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $clients = User::getClients($id);
        $clients = User::updateClients($clients, $data);
        return redirect()->route('index')->with('success', 'Clients updated successfully');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $clients = User::getClients($id);
        User::delete($clients);
        return redirect()->route('index')->with('success', 'Clients deleted successfully');
    }
}
