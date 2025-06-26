<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Inertia\Inertia;


use Illuminate\Http\Request;

class clientController extends Controller
{
    
    public function index()
    {
        $clients = Client::select('id', 'name', 'email', 'phone', 'address', 'postal_code', 'city', 'state', 'country')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
           
        return Inertia::render('Clients/Index', [
            'clients' => $clients,
        ]);


    }

    public function show($id)
    {
        // Logic to retrieve and return a specific client by ID
    }

    public function store(Request $request)
    {
        // Logic to create a new client
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing client
    }

    public function destroy($id)
    {
        // Logic to delete a client
    }
}
