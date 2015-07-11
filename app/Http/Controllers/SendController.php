<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Outbox;

use App\Http\Requests\CreateSendRequest;

class SendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('send.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateSendRequest $request)
    {
        $send = new Outbox;

        $send->TextDecoded = $request->TextDecoded;
        $send->DestinationNumber = $request->DestinationNumber;
        $send->Class = $request->Class;

        $send->save();

        return redirect()->route('outbox.index');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @return Response
    //  */
    // public function store(Request $request)
    // {
    //     $input = $request->all();
    //     dd($input);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
