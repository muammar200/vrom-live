<x-front-layout>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif
        
        <!-- Main Content -->
        <section class="bg-darkGrey relative py-[70px]">
            <div class="container">
                <div class="flex flex-col items-center">
                    <header class="mb-[30px] text-center">
                        <h2 class="font-bold text-dark text-[26px] mb-1">
                            Sign In & Drive
                        </h2>
                        <p class="text-base text-secondary">We will help you get ready today</p>
                    </header>
         
                    <!-- Form Card -->
                    <form action="{{ route('login') }}" class="bg-white p-[30px] pb-10 rounded-3xl max-w-[490px] w-full" method="POST" id="signInForm">
                        @csrf
                        <x-validation-errors class="mb-4" />
                        <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">

                            
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
                                <label for="" class="text-base font-semibold text-dark">
                                    Password
                                </label>
                                <input type="password" name="password" id="password"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                                    placeholder="Insert password">
                                <a href="#"
                                    class="mt-1 text-base text-right underline text-secondary underline-offset-2">
                                    Forgot My Password
                                </a>
                            </div>
                            <!-- Sign In Button -->
                            <div class="col-span-2 mt-[26px]">
                                <!-- Button Primary -->
                                <div class="p-1 rounded-full bg-primary group">
                                    <a href="#!" class="btn-primary" id="signInButton">
                                        <p>
                                            Sign In
                                        </p>
                                        <img src="/svgs/ic-arrow-right.svg" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <a href="{{ route('register') }}" class="btn-secondary">
                                    <p>Create New Account</p>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <script>
            // on signup click, submit the form
      $('#signInButton').click(function () {
          $('#signInForm').submit();
      });
        </script>
        
</x-front-layout>
