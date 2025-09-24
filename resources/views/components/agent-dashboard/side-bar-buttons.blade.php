@props(['title' => '','message' => ''])
<li>
    <a {{ $attributes->merge(['class' => "sidebar-item flex items-center px-4 py-3 rounded-xl" ]) }}>

        {{ $slot }}

        <span class="font-medium">
            {{ $title }}
        </span>
        
        {!! 
            $message != '' 
            ? 
            '<span class="ml-auto bg-[#00ff88] text-[#12181f] text-xs px-2 py-1 rounded-full font-bold">'
                .($message).
            '</span>'
            :
            null
        !!}
        
    </a>
</li>