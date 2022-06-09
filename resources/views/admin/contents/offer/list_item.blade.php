<tr>
    <th scope="row" class="align-middle">{{ $counter++ }}</th>
    <td class="align-middle">
{{--        {{ $offer->name(Auth::user()->locale()) }}--}}
    </td>
    <td class="align-middle">
{{--        @if ($publishAt = $offer->publishAt())--}}
{{--            {{ $publishAt->toDateTimeString() }}--}}
{{--        @else--}}
{{--            ---}}
{{--        @endif--}}
    </td>
    <td class="align-middle">@include('admin.contents.offer.list_item_action', ['offer' => $offer])</td>
</tr>
