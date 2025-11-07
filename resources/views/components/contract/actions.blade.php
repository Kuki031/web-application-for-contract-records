@props(['item'])

<div class="contract-actions">
    <div class="contract-actions-main">
        @if ($item->word_link)
            <a class="contract-actions--word" href="{{ route('contract.download', $item) }}" target="_blank">
                <div class="contract-icon contract-icon--word"></div>
            </a>
        @endif

        @if ($item->pdf_link)
            <a class="contract-actions--pdf" href="{{ route('contract.viewPDF', $item) }}" target="_blank">
                <div class="contract-icon contract-icon--pdf"></div>
            </a>
        @else
            <form class="pdf-form" action="{{ route('contract.upload', $item) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="file" name="pdf_link" id="pdfUpload-{{ $item->id }}" accept="application/pdf"
                    hidden>

                <label class="contract-actions--pdf" for="pdfUpload-{{ $item->id }}">Dodaj PDF</label>
            </form>
    </div>
</div>
@endif
