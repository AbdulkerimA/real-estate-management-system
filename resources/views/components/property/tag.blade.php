@props(['status'=>'available'])

<div {{ $attributes->merge(['class'=> "absolute top-4 left-4 "
 . ($status == 'available' ? 'bg-green-400' : 'bg-orange-400') . 
 " text-white px-3 py-1 rounded-full text-sm "]) }}
 >
    {{ $slot }}
</div>