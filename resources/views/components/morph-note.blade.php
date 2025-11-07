@props(['notes', 'resource', 'item'])

<div class="notes-main-wrap">

    <div class="notes-div-wrap">
        <div class="notes-div-item">
            <div>
                <form class="morph-note-form" action="{{ route('note.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="note">
                    <input type="hidden" name="noteable_type" value="{{ $resource }}">
                    <input type="hidden" name="noteable_id" value="{{ $item?->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <button type="submit" class="show-table-btn show-table-btn--new new-note">Napomena+</button>
                </form>
            </div>
        </div>

        @foreach ($notes as $note)
            <div class="notes-div-item">
                <div class="note-div-item__note">
                    <p class="morph-note-p">Napomena: <span class="morph-note-span">{{ $note->note }}</span></p>
                    <p class="morph-note-p">Napisao/la: <span class="morph-note-span">{{ $note->user->username }}</span>
                    </p>
                    <p class="morph-note-p">Napisano: <span
                            class="morph-note-span">{{ $note->created_at_display }}</span></p>
                    <p class="morph-note-p">Ažurirano: <span
                            class="morph-note-span">{{ $note->updated_at_display }}</span></p>
                    <div class="morph-note-actions">


                        <form class="morph-note-form morph-note-form--update" action="{{ route('note.update', $note) }}"
                            method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="note" value="{{ $note->note }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <button type="submit" class="show-table-btn edit-note">Uredi</button>
                        </form>

                        <form class="morph-note-form morph-note-form--delete"
                            action="{{ route('note.destroy', $note) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="show-table-btn delete-note">Obriši</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <x-pagination :items="$notes" />
    </div>
</div>
