<x-front-layout>
    <!-- Maps Section -->
    <section class="relative py-20 bg-darkGrey">
        <div class="container px-4 mx-auto">
            <!-- Header -->
            <header class="mb-12 text-center">
                <h2 class="mb-2 text-2xl font-bold md:text-3xl">
                    Temukan Lokasi Kami
                </h2>
                <p class="text-base text-gray-300">Lihat lokasi kami dan rencanakan kunjungan Anda di Makassar.</p>
            </header>

            <!-- Map Container -->
            <div class="relative w-full h-80 md:h-[500px] rounded-lg overflow-hidden">
                <!-- Google Maps Embed -->
                <iframe 
                    class="w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12674.508469373142!2d119.417936!3d-5.147667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbfb0e2e4d7b8e3%3A0x4b92945f02d4476a!2sJl.%20Jenderal%20Sudirman%20No.1%2C%20Makassar%2C%20Sulawesi%20Selatan%2049010!5e0!3m2!1sen!2sid!4v1647503818477!5m2!1sen!2sid"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
                <!-- Overlay for Map Controls (optional) -->
                <div class="absolute inset-0 bg-black opacity-30"></div>
            </div>

            <!-- Map Details -->
            <div class="mt-8 text-center">
                <h3 class="mb-2 text-lg font-semibold text-white">
                    Alamat Kami
                </h3>
                <p class="text-base text-gray-300">
                    Jl. Jenderal Sudirman No.1, Makassar, Sulawesi Selatan 9010
                </p>
                <p class="text-base text-gray-300">
                    Telepon: (0411) 123456
                </p>
            </div>
        </div>
    </section>

    <x-footer></x-footer>
</x-front-layout>
