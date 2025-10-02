<x-main-templet>
    @slot("navLink")
        <x-nav.nav-layout>
            
        </x-nav.nav-layout>
    @endslot

    @slot("properties")
        @foreach ($properties as $property)
            <x-property.property-card :property="$property" />
        @endforeach
    @endslot

    @slot("testimonials")
        <x-testimonial.testimonial-card>
            
        </x-testimonial.testimonial-card>
    @endslot

    @slot("footer")
        <x-footer>

        </x-footer>
    @endslot

</x-main-templet>