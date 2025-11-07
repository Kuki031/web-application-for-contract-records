<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Domain;
use App\Models\Hosting;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function store(StoreNoteRequest $request)
    {
        $modelClass = match ($request->noteable_type) {
            'domain' => Domain::class,
            'hosting' => Hosting::class,
        };

        $noteable = $modelClass::findOrFail($request->noteable_id);

        $noteable->notes()->create([
            'note' => $request->note,
            'noteable_type' => $noteable,
            'noteable_id' => $noteable->id,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Napomena uspješno dodana.');
    }

    public function update(Note $note, UpdateNoteRequest $request)
    {
        $note->update($request->validated());
        return back()->with("success", "Napomena uspješno ažurirana.");
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return back()->with("success", "Napomena uspješno izbrisana.");
    }
}
