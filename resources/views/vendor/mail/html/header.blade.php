@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://myimgs.org/storage/images/3684/WhatsApp_Image_2025-02-11_at_10.png" class="logo" alt="AULSH Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>