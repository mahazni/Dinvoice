<?php

namespace Dinvoice\Http\Controllers\V1\General;

use Dinvoice\Http\Controllers\Controller;
use Dinvoice\Http\Requests\NotesRequest;
use Dinvoice\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        $notes = Note::latest()
            ->applyFilters($request->only(['type', 'search']))
            ->paginate($limit);

        return response()->json([
            'notes' => $notes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotesRequest $request)
    {
        $note = Note::create($request->validated());

        return response()->json([
            'note' => $note
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Dinvoice\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return response()->json([
            'note' => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Dinvoice\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(NotesRequest $request, Note $note)
    {
        $note->update($request->validated());

        return response()->json([
            'note' => $note
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Dinvoice\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
