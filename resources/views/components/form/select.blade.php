<select {{ $attributes->merge(['class' =>                          
"input-field w-full px-4 py-4 bg-dark-secondary border border-gray-600 rounded-xl text-white focus:outline-none focus:border-accent-green focus:ring-2 focus:ring-accent-green/20"
 ]) }}                         
>
   {{ $slot }}
</select>