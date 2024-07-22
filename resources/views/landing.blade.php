<x-front-layout>
    <!-- Hero -->
    <section class="container relative pb-[100px] pt-[30px]">
        <div class="flex flex-col items-center justify-center gap-[30px]">
            <!-- Preview Image -->
            <div class="relative">
                <div class="absolute z-0 hidden lg:block">
                    <div class="font-extrabold text-[220px] text-darkGrey tracking-[-0.06em] leading-[101%]">
                        <div data-aos="fade-right" data-aos-delay="300">
                            TOP
                        </div>
                        <div data-aos="fade-left" data-aos-delay="600">
                            CAR
                        </div>
                    </div>
                </div>
                <img src="{{ $bestItem->thumbnail }}" class="w-full max-w-[963px] z-10 relative" alt=""
                    data-aos="zoom-in" data-aos-delay="950">
            </div>

            <!-- Car Name -->
            <div class="flex items-center gap-y-12">
                <h1 class="font-bold text-dark text-xl md:text-[26px] text-center uppercase" data-aos="zoom-in" data-aos-delay="950">
                    {{ $bestItem->brand->name }} {{ $bestItem->name }}
                </h1>
            </div>
            
            <div class="flex flex-col lg:flex-row items-center justify-around lg:gap-[60px] gap-7">
                
                <!-- Car Details -->
                <div class="flex items-center gap-y-12">
                    @php
                        $features = explode(',', $bestItem->features);
                        $delay = 1400;
                    @endphp
                    @foreach ($features as $index => $feature)
                        <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left"
                            data-aos-delay="{{ $delay + ($index * 200) }}">
                            <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">
                                {{ $feature }}
                            </h6>
                        </div>
                        <span class="vr" data-aos="fade-left" data-aos-delay="{{ $delay + ($index * 200) + 200 }}"></span>
                    @endforeach
                </div>
                <!-- Button Primary -->
                <div class="p-1 rounded-full bg-primary group" data-aos="zoom-in" data-aos-delay="{{ $delay + (count($features) * 200) }}">
                    <a href="{{ route('front.checkout', $bestItem->slug) }}" class="btn-primary">

                        <p>
                            Rental
                        </p>
                        <img src="/svgs/ic-arrow-right.svg" alt="">
                    </a>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Popular Cars -->
    <section class="bg-darkGrey">
        <div class="container relative py-[100px]">
            <header class="mb-[30px]">
                <h2 class="font-bold text-dark text-[26px] mb-1">
                    Mobil Lainnya
                </h2>
                <p class="text-base text-secondary">Mulai hari hebatmu</p>
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

    <!-- Extra Benefits -->
    <section class="container relative pt-[100px]">
        <div class="flex items-center flex-col md:flex-row flex-wrap justify-center gap-8 lg:gap-[120px]">
            <img src="/images/iluss.png" class="w-full lg:max-w-[536px]" alt="">
            <div class="max-w-[268px] w-full">
                <div class="flex flex-col gap-[30px]">
                    <header>
                        <h2 class="font-bold text-dark text-[26px] mb-1">
                            Extra Benefits
                        </h2>
                        {{-- <p class="text-base text-secondary">.</p> --}}
                    </header>
                    <!-- Benefits Item -->
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-car.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Delivery
                            </h5>
                            {{-- <p class="text-sm font-normal text-secondary">Just sit tight and wait</p> --}}
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-card.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Pricing
                            </h5>
                            {{-- <p class="text-sm font-normal text-secondary">12x Pay Installment</p> --}}
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-securityuser.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Secure
                            </h5>
                            {{-- <p class="text-sm font-normal text-secondary">Use your plate number</p> --}}
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-dark rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-convert3dcube.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                Fast Trade
                            </h5>
                            {{-- <p class="text-sm font-normal text-secondary">Change car faster</p> --}}
                        </div>
                    </div>
                </div>
                <!-- CTA Button -->
                <div class="mt-[50px]">
                    <!-- Button Primary -->
                    <div class="p-1 rounded-full bg-primary group">
                        <a href="#!" class="btn-primary">
                            <p>
                                Jelajahi Mobil
                            </p>
                            <img src="/svgs/ic-arrow-right.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="container relative py-[100px]">
    <header class="text-center mb-[50px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
            Pertanyaan yang Sering Diajukan
        </h2>
        <p class="text-base text-secondary">Pelajari lebih lanjut tentang Vrom dan raih kesuksesan</p>
    </header>

    <!-- Questions -->
    <div class="grid md:grid-cols-2 gap-x-[50px] gap-y-6 max-w-[910px] w-full mx-auto">
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
            id="faq1">
            <div class="flex items-center justify-between gap-1">
                <p class="text-base font-semibold text-dark">
                    Apa yang harus saya lakukan jika saya menabrak mobil?
                </p>
                <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
            </div>
            <div class="hidden pt-4 max-w-[335px]" id="faq1-content">
                <p class="text-base text-dark leading-[26px]">
                    Jika Anda mengalami kecelakaan, segera hubungi layanan pelanggan kami untuk bantuan lebih lanjut.
                </p>
            </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
            id="faq2">
            <div class="flex items-center justify-between gap-1">
                <p class="text-base font-semibold text-dark">
                    Bagaimana cara membayar sewa mobil?
                </p>
                <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
            </div>
            <div class="hidden pt-4 max-w-[335px]" id="faq2-content">
                <p class="text-base text-dark leading-[26px]">
                    Anda dapat membayar sewa mobil melalui transfer bank, kartu kredit, atau dompet digital.
                </p>
            </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
            id="faq3">
            <div class="flex items-center justify-between gap-1">
                <p class="text-base font-semibold text-dark">
                    Apakah saya perlu mengisi bahan bakar sebelum mengembalikan mobil?
                </p>
                <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
            </div>
            <div class="hidden pt-4 max-w-[335px]" id="faq3-content">
                <p class="text-base text-dark leading-[26px]">
                    Ya, Anda diharapkan mengisi penuh bahan bakar mobil sebelum mengembalikannya.
                </p>
            </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
            id="faq4">
            <div class="flex items-center justify-between gap-1">
                <p class="text-base font-semibold text-dark">
                    Bisakah saya membatalkan pemesanan saya?
                </p>
                <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
            </div>
            <div class="hidden pt-4 max-w-[335px]" id="faq4-content">
                <p class="text-base text-dark leading-[26px]">
                    Ya, Anda dapat membatalkan pemesanan Anda. Harap periksa syarat dan ketentuan pembatalan kami.
                </p>
            </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
            id="faq5">
            <div class="flex items-center justify-between gap-1">
                <p class="text-base font-semibold text-dark">
                    Apakah ada biaya tambahan untuk pengemudi tambahan?
                </p>
                <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
            </div>
            <div class="hidden pt-4 max-w-[335px]" id="faq5-content">
                <p class="text-base text-dark leading-[26px]">
                    Tidak, tidak ada biaya tambahan untuk pengemudi tambahan selama mereka terdaftar dalam pemesanan.
                </p>
            </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
            id="faq6">
            <div class="flex items-center justify-between gap-1">
                <p class="text-base font-semibold text-dark">
                    Bagaimana cara mengubah detail pemesanan saya?
                </p>
                <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
            </div>
            <div class="hidden pt-4 max-w-[335px]" id="faq6-content">
                <p class="text-base text-dark leading-[26px]">
                    Anda dapat mengubah detail pemesanan Anda dengan menghubungi layanan pelanggan kami atau melalui situs web kami.
                </p>
            </div>
        </a>
    </div>
</section>


    <!-- Instant Booking -->
    <section class="relative bg-[#060523]">
    <div class="container py-20">
        <div class="flex flex-col">
            <header class="mb-[50px] max-w-[360px] w-full">
                <h2 class="font-bold text-white text-[26px] mb-4">
                    Ayo Berkendara Hari Ini. <br>
                    Berkendara Lebih Cepat.
                </h2>
                <p class="text-base text-subtlePars">Dapatkan pemesanan instan untuk mengejar apa pun yang ingin Anda capai hari ini.</p>
            </header>
            <!-- Button Primary -->
            {{-- <div class="p-1 rounded-full bg-primary group w-max">
                <a href="details.html" class="btn-primary">
                    <p>
                        Pesan Sekarang
                    </p>
                    <img src="/svgs/ic-arrow-right.svg" alt="">
                </a>
            </div> --}}
        </div>
        <div class="absolute bottom-[-30px] right-0 lg:w-[764px] max-h-[332px] hidden lg:block">
            <img src="/images/porsche_small.webp" alt="">
        </div>
    </div>
</section>


    <x-footer></x-footer>


</x-front-layout>
