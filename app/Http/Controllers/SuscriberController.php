<?php

namespace App\Http\Controllers;

use App\Models\Suscriber;
use Illuminate\Http\Request;

class SuscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Suscriber::all();
        return view("admin.suscriberslist",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'email'=> 'required']);
        $data=Suscriber::create($request->all());
        return redirect()->back()->with('success', 'You are suscribed successfully!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Suscriber $suscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suscriber $suscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suscriber $suscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $suscriber=Suscriber::find($id);
        $suscriber->delete();
        return redirect()->route('admin.suscriber')->with('alert', 'Suscriber removed successfully!');
    }
    public function exportCSV()
    {
        $filename = 'suscribers_data.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID','Email','Time of Suscription']);

            Suscriber::chunk(25, function ($suscribers) use ($handle) {
                foreach ($suscribers as $suscriber) {
                    $data = [
                        isset($suscriber->id)? $suscriber->id : '',
                        isset($suscriber->email)? $suscriber->email : '',
                        isset($suscriber->created_at)? $suscriber->created_at : '',
                    ];
                    fputcsv($handle, $data);
                }
            });
            fclose($handle);
        }, 200, $headers);
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'import_csv' => 'required|mimes:csv',
        ]);
        $file = $request->file('import_csv');
        $handle = fopen($file->path(), 'r');
        fgetcsv($handle);

        $chunksize = 25;
        while(!feof($handle))
        {
            $chunkdata = [];

            for($i = 0; $i<$chunksize; $i++)
            {
                $data = fgetcsv($handle);
                if($data === false)
                {
                    break;
                }
                $chunkdata[] = $data;
            }
            $this->getchunkdata($chunkdata);
        }
        fclose($handle);
        return redirect()->route('suscriber.create')->with('success', 'Data has been added successfully.');
    }

    public function getchunkdata($chunkdata)
    {
        foreach($chunkdata as $column){
            $id = $column[0];
            $email = $column[1];
            $created_at = $column[2];
            $suscriber = new Suscriber();
            $suscriber->id = $id;
            $suscriber->email = $email;
            $suscriber->created_at = $created_at;
            $suscriber->save();
        }
    }

}
