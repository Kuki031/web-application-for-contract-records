@props(['tdName', 'item', 'tdValues', 'index'])

@php
    $wordCell = 'Word';
    $pdfCell = 'PDF link';
@endphp

<tr>
    @if ($tdName === $wordCell && $item->word_link)
        <td>{{ $tdName }}</td>
        <td>
            <a class="contract-actions--word" href="{{ route('contract.download', $item) }}" target="_blank">
                Preuzmi word
            </a>
        </td>
    @elseif ($tdName === $pdfCell && $item->pdf_link)
        <td>{{ $tdName }}</td>
        <td>
            <a class="contract-actions--pdf" href="{{ route('contract.viewPDF', $item) }}" target="_blank">
                Pregledaj PDF
            </a>
        </td>
    @else
        <td>{{ $tdName }}</td>
        <td>{{ $item->{$tdValues[$index]} ?? '—' }}</td>
    @endif
</tr>
