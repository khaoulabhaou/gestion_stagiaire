@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://i.ibb.co/qHFwmv8/Whats-App-Image-2025-04-02-at-13-01-08-fb041c0e-removebg-preview.png" class="logo" alt="AULSH Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>