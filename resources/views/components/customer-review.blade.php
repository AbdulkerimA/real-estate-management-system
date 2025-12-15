@props([
    'comment',
])
@php
    // dump($comment);
@endphp
<div class="review-card rounded-2xl p-6">
    <div class="flex items-center mb-4">
        
        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
            BW
        </div>

        <div>
            <h4 class="font-semibold">{{ $comment->user->name }}</h4>
            <div class="star-rating text-sm">
                @for ($i = 0; $i < number_format($comment->agent->averageRating() ?? 1 ,0); $i++)
                    ⭐
                @endfor    
            </div>
        </div>
    </div>

    <p class="text-gray-300 italic">
        {{ $comment->comment ?? "just rating with no comment" }}
    </p>
</div>