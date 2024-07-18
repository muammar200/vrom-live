<x-front-layout>
        
           <!-- Main Content -->
           <section class="bg-darkGrey relative py-[70px]">
            <div class="container">
                <div class="flex flex-col items-center">
                    <header class="mb-[30px] text-center">
                        <h2 class="font-bold text-dark text-[26px] mb-1">
                            Sign Up & Drive
                        </h2>
                        <p class="text-base text-secondary">We will help you get ready today</p>
                    </header>
                    <!-- Form Card -->
                    <form action="{{ route('register') }}" class="bg-white p-[30px] pb-10 rounded-3xl max-w-[490px] w-full" 
                    method="POST" enctype="multipart/form-data" id="signUpForm">
                    @csrf
                    <x-validation-errors class="mb-4" />
                        <!-- User Photo -->
                        <div class="mb-[50px] flex justify-center">
                            <div class="relative">
                                <img src="/svgs/ic-default-photo.svg" class="w-[120px] h-[120px] rounded-full"
                                    alt="" id="imageSrc">
                                <a href="javascript:void(0);" id="btnUploadPhoto" class="">
                                    <img src="/svgs/ic-btn_upload.svg"
                                        class="w-[36px] h-[36px] rounded-full absolute right-[-7px] bottom-[9px]"
                                        alt="">
                                </a>
                                <a href="javascript:void(0);" id="btnDeletePhoto" class="hidden">
                                    <img src="/svgs/ic-btn_delete.svg"
                                        class="w-[36px] h-[36px] rounded-full absolute right-[-7px] bottom-[9px]"
                                        alt="">
                                </a>
                            </div>
                            <input type="file" name="photo" id="photo" class="hidden">
                        </div>
                        <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
                            <!-- Full Name -->
                            <div class="flex flex-col col-span-2 gap-3">
                                <label for="full" class="text-base font-semibold text-dark">
                                    Full Name
                                </label>
                                <input type="text" name="name" id="fullname"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                                    placeholder="Insert Full Name">
                            </div>
                            <!-- Phone Number -->
                            <div class="flex flex-col col-span-2 gap-3">
                                <label for="phone" class="text-base font-semibold text-dark">
                                    Phone Number
                                </label>
                                <input type="number" name="phone" id="phone"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                                    placeholder="Insert Phone Number">
                            </div>
                            <!-- Email -->
                            <div class="flex flex-col col-span-2 gap-3">
                                <label for="email" class="text-base font-semibold text-dark">
                                    Email Address
                                </label>
                                <input type="email" name="email" id="email"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                                    placeholder="Insert Email Address">
                            </div>
                            <!-- Password -->
                            <div class="flex flex-col col-span-2 gap-3">
                                <label for="password" class="text-base font-semibold text-dark">
                                    Password
                                </label>
                                <input type="password" name="password" id="password"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                                    placeholder="Insert password">
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox name="terms" id="terms" required />
            
                                        <div class="ms-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                        @endif
                            
                            <!-- Button -->
                            <div class="col-span-2 mt-[26px]">
                                <!-- Button Primary -->
                                <div class="p-1 rounded-full bg-primary group">
                                    <a href="#!" class="btn-primary" id="signUpButton">
                                        <p>
                                            Create My Account
                                        </p>
                                        <img src="/svgs/ic-arrow-right.svg" alt="">
                                    </a>
                                </div>
                            </div>

                            <!-- Create New Account Button -->
                            <div class="col-span-2">
                                <a href="{{ route('login') }}" class="btn-secondary">
                                    <p>Sign In</p>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <script>
            // on signup click, submit the form
         $('#signUpButton').click(function () {
            console.log('klik');
          $('#signUpForm').submit();
        });
        </script>
    
</x-front-layout>
