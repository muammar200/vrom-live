<x-front-layout>
    <!-- Popular Cars -->
    <section class="bg-darkGrey">
        <div class="container relative py-[100px]">
            <header class="mb-[30px]">
                <h2 class="font-bold text-dark text-[26px] mb-1">
                    Popular Cars
                </h2>
                <p class="text-base text-secondary">Start your big day</p>
            </header>

            <!-- Cars -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
                <!-- Card -->
                @forelse ($popularItems as $item)
                    <div class="card-popular">
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                {{ $item->name }}
                            </h5>
                            <p class="text-sm font-normal text-secondary">{{ $item->type ? $item->type->name : '-' }}
                            </p>
                            <a href="{{ route('front.detail', $item->slug) }}" class="absolute inset-0"></a>
                        </div>
                        <img src="{{ $item->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                            alt="Car Image">
                        <div class="flex items-center justify-between gap-1">
                            <!-- Price -->
                            <p class="text-sm font-normal text-secondary">
                                <span
                                    class="text-base font-bold text-primary">{{ number_format($item->price) }}</span>/day
                            </p>
                            <!-- Rating -->
                            <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                                @php
                                    $rating = $item->star;
                                @endphp
                                ({{ $ratingNumber = ($rating == floor($rating)) ? number_format($rating, 0) : number_format($rating, 1); }}/5)
                                <img src="/svgs/ic-star.svg" alt="">
                            </p>
                        </div>
                    </div>
                @empty
                    <h1>No Car Found</h1>
                @endforelse

            </div>
        </div>
    </section>

    {{-- Other Cars --}}
    <section class="bg-darkGrey">
        <div class="container relative py-[100px]">
            <header class="mb-[30px]">
                <h2 class="font-bold text-dark text-[26px] mb-1">
                    Other Cars
                </h2>
            </header>

            <!-- Cars -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
                <!-- Card -->
                @forelse ($otherItems as $item)
                    <div class="card-popular">
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                {{ $item->name }}
                            </h5>
                            <p class="text-sm font-normal text-secondary">{{ $item->type ? $item->type->name : '-' }}
                            </p>
                            <a href="{{ route('front.detail', $item->slug) }}" class="absolute inset-0"></a>
                        </div>
                        <img src="{{ $item->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                            alt="Car Image">
                        <div class="flex items-center justify-between gap-1">
                            <!-- Price -->
                            <p class="text-sm font-normal text-secondary">
                                <span
                                    class="text-base font-bold text-primary">{{ number_format($item->price) }}</span>/day
                            </p>
                            <!-- Rating -->
                            <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                                @php
                                    $rating = $item->star;
                                @endphp
                                ({{ $ratingNumber = ($rating == floor($rating)) ? number_format($rating, 0) : number_format($rating, 1); }}/5)
                                <img src="/svgs/ic-star.svg" alt="">
                            </p>
                        </div>
                    </div>
                @empty
                    <h1>No Car Found</h1>
                @endforelse

            </div>
        </div>
    </section>

    <x-footer></x-footer>
</x-front-layout>