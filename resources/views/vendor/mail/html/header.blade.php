@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://i.postimg.cc/L4Lp4JqL/Whats-App-Image-2025-02-11-at-10-38-33-526755f1-1-Copy-removebg-preview.png" class="logo" alt="AULSH Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>