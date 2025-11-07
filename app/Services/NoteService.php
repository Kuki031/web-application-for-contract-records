<?php

namespace App\Services;

class NoteService {

    public function getMorphedNotes($model)
    {
        return $model->notes()->orderByDesc("updated_at")->paginate(3);
    }
}
