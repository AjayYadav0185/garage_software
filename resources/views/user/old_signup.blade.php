<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
  <title> Rappidx Signup Page</title>
  <!-- <link href=" https://cdn.jsdelivr.net/npm/tailwindcss@4.1.4/index.min.css"> -->
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="./style.css" rel="stylesheet">
</head>
<style>
  .mobile-menu {
    left: 200%;
    transition: 0.5s;
  }

  .mobile-menu.active {
    left: 0;

  }

  .mobile-menu ul li ul {
    display: none;

  }

  .mobile-menu ul li:hover ul {
    display: block;
  }

  /* -------------------------  */
  body {
    text-align: center;
  }

  .box {
    width: 100%;
    text-align: center;
  }

  .fadeInUp {
    animation: fadeInUp 1s ease backwards;
  }

  @keyframes fadeInUp {
    0% {
      transform: translate(0px, 100px);
      opacity: 0;
    }

    100% {
      transform: translate(0px, 0);
      opacity: 1;
    }
  }

  .mobile-menu {
    left: 200%;
    transition: 0.5s;
  }

  .mobile-menu.active {
    left: 0;

  }

  .mobile-menu ul li ul {
    display: none;

  }

  .mobile-menu ul li:hover ul {
    display: block;
  }

  /* --------------------------  */
  body {
    text-align: center;
  }

  .box {
    width: 100%;
    text-align: center;
  }

  .fadeInUp {
    animation: fadeInUp 1s ease backwards;
  }

  @keyframes fadeInUp {
    0% {
      transform: translate(0px, 100px);
      opacity: 0;
    }

    100% {
      transform: translate(0px, 0);
      opacity: 1;
    }
  }



  .card:hover {
    background: linear-gradient(240deg, rgb(233, 213, 255), rgb(255, 251, 235));
  }

  .card2:hover {
    background: linear-gradient(240deg, rgb(186, 230, 253), rgb(255, 251, 235));

  }

  input::placeholder {
    font-size: 12px;
    /* set your desired size here */
  }

  select {
    font-size: 12px !important;
    /* your desired size */
  }
</style>

<body class="">
  <!-- Contenido principal -->
  <main class="bg-white">
    <section class="first px-6 pb-8">
      <div class=row>
        <section class="container pt-5 mx-auto">
          <div class="mx-auto max-w-full">
            <div class="grid lg:grid-cols-2 grid-cols-1 lg:gap-28 md:gap-8">
              <div class="lg:mb-0 mb-10">
                <div class="group w-full h-full">
                  <div class="relative h-full">
                    <div class="col-6 lg:px-16 md:px-4 sm:px-0">
                      <div class="circle lg:justify-items-start md:justify-items-center sm:justify-items-center">
                        <img width="100%" height="100%"
                          src="https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276676-scaled.jpg"
                          alt="">
                      </div>
                    </div>
                    <div class="absolute bottom-0 w-full lg:p-11 p-5">
                    </div>
                  </div>
                </div>
              </div>
              <div class="border rounded-3xl shadow-2xl shadow-xl/30 bg-white">
                <div class="px-8 py-4">
                  <div class="flex justify-center">
                    <img width="70" height="70"
                      src="https://rappidx.intileotech.com/wp-content/uploads/2024/06/logo-removebg-preview-21.png"
                      class="attachment-full  wp-image-1419" alt="">
                  </div>
                  {{-- <h4 class="text-center text-3xl">Welcome</h4> --}}
                  <h6 class="text-center text-xl">Let’s Optimize Your Shipping Goals</h6>

                  {{-- Validation Error --}}
                  @if ($errors->any())
            <div class="auto-hide bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-2">
            {{ $errors->first() }}
            </div>
          @endif

                  {{-- Session Error --}}
                  @if (session()->has('error'))
            <div class="auto-hide bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-2">
            {{ session('error') }}
            </div>
          @endif

                  {{-- Session Success --}}
                  @if (session()->has('success'))
            <div class="auto-hide bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-2">
            {{ session('success') }}
            </div>
          @endif

                  <form class="max-w-4xl mx-auto p-4  rounded-xl " action="{{ url('singupsave') }}"
                    method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                      <!-- First & Last Name -->
                      <input type="text" name="name" placeholder="First Name"
                        class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required />

                      <input type="text" name="last_name" placeholder="Last Name"
                        class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required />

                      <!-- City and State -->
                      <input type="text" name="city" placeholder="City"
                        class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required />

                      <select name="state"
                        class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm text-gray-700" required>
                        <option selected disabled>Select State</option>
                        @foreach ($state as $item)
              <option value="{{ $item->id }}">{{ $item->state }}</option>
            @endforeach
                      </select>

                      <!-- Company Name (full width) -->
                      <div class="md:col-span-2">
                        <input type="text" name="companystorename" placeholder="Company Name"
                          class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required />
                      </div>

                      <!-- Email -->
                      <div class="md:col-span-2">
                        <input type="email" name="email" placeholder="Email ID"
                          class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required />
                      </div>
                      <!-- Mobile -->
                      <input type="text" name="mobile" placeholder="Mobile Number"
                        class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required />

                      <!-- Password -->
                      <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Password"
                          class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required />

                        <span onclick="toggleTailwindPassword()"
                          class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer text-gray-600">
                          <i class="fa fa-eye" id="tailwindToggleIcon"></i>
                        </span>
                      </div>

                      <!-- Monthly Shipment -->
                      <select name="monthly_shipment"
                        class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm" required>
                        <option selected disabled>Monthly Shipment</option>
                        <option>Setting Up New Business</option>
                        <option>0-30 Orders</option>
                        <option>31-100 Orders</option>
                        <option>101-1000 Orders</option>
                        <option>1001 - 3000 Orders</option>
                        <option>3001 + Orders</option>
                      </select>

                      <!-- Seller Type -->
                      <select name="sellertype" class="w-full px-3 py-1.5 border border-gray-400 rounded-md text-sm"
                        required>
                        <option selected disabled>Select Seller Type</option>
                        <option>Domestic Shipping</option>
                        <option>B2B Cargo</option>
                        <option>International Shipping</option>
                        <option>Hyperlocal ( Quick Delivery )</option>
                        <option>Franchise</option>
                      </select>

                      <!-- Hidden User Type -->
                      <input type="hidden" name="usertype" value="client" />
                    </div>

                    <!-- Terms and Submit -->
                    <div class="mt-6">
                      <p class="text-sm text-gray-600 mb-4">
                        By signing up, you agree to Rappidx’s
                        <a target="_blank" href="https://rappidx.intileotech.com/terms-condition/"
                          class="text-blue-600 underline">Terms of Service</a> &
                        <a target="_blank" href="https://rappidx.intileotech.com/privacy-policy/"
                          class="text-blue-600 underline">Privacy Policy</a>.
                      </p>

                      <button type="submit"
                        class="w-full bg-[#AAB3C3] text-black font-semibold py-2 rounded-md hover:bg-[#939baa] transition">
                        Signup
                      </button>

                      <p class="text-center mt-4 text-gray-600">
                        Already have an account?
                        <a href="{{ route('user.login') }}" class="text-blue-500 underline">Login</a>
                      </p>
                    </div>
                  </form>



                </div>
              </div>
            </div>
        </section>
      </div>
    </section>
    {{-- <section class=" px-6 pb-8">
      <div class="grid grid-cols-1">
        <h1 class="text-3xl sm:text-4xl md:text-4xl font-bold text-center py-10">How it Works</h1>
        <div class="justify-items-center lg:px-48 md:px-4 sm:px-0">
          <img fetchpriority="high" decoding="async" width="2560" height="540"
            src="https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276668-scaled.jpg"
            class="attachment-full size-full wp-image-2684" alt=""
            srcset="https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276668-scaled.jpg 2560w, https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276668-300x63.jpg 300w, https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276668-1024x216.jpg 1024w, https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276668-768x162.jpg 768w, https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276668-1536x324.jpg 1536w, https://rappidx.intileotech.com/wp-content/uploads/2024/12/Frame-1171276668-2048x432.jpg 2048w"
            sizes="(max-width: 2560px) 100vw, 2560px">
        </div>
      </div>
    </section> --}}

    <section class="">
      <div class="grid grid-cols-1">
        <h5 class="text-2xl sm:text-3xl md:text-2xl font-bold text-center py-10">How it Works</h5>
        <div class="justify-items-center lg:px-48 md:px-4 sm:px-0">
          <img src="{{ asset('img/Frame-1171276668-2048x432.jpg') }}" class="w-full h-auto object-cover">
        </div>
      </div>
    </section>
    <section class=" px-6 pb-8">
      <div class="grid grid-cols-1">
        <h5 class="text-2xl sm:text-3xl md:text-2xl font-bold text-center py-10">Delivery partner</h5>
        <div class="justify-items-center lg:px-48 md:px-8 sm:px-4">
          <img decoding="async" width="960" height="523"
            src="https://rappidx.intileotech.com/wp-content/uploads/2025/04/Group-1171275035-1024x558.png"
            class="attachment-large size-large wp-image-3564" alt="" srcset="https://rappidx.intileotech.com/wp-content/uploads/2025/04/Group-1171275035-1024x558.png 1024w, 
            https://rappidx.intileotech.com/wp-content/uploads/2025/04/Group-1171275035-300x163.png 300w,
             https://rappidx.intileotech.com/wp-content/uploads/2025/04/Group-1171275035-768x418.png 768w, 
             https://rappidx.intileotech.com/wp-content/uploads/2025/04/Group-1171275035-1536x837.png 1536w,
              https://rappidx.intileotech.com/wp-content/uploads/2025/04/Group-1171275035-2048x1116.png 2048w"
            sizes="(max-width: 960px) 100vw, 960px">
        </div>
      </div>
    </section>
    {{-- <section class=" px-6 pb-8 container mx-auto ">
      <div class="grid grid-cols-1">
        <h1 class="text-3xl sm:text-4xl md:text-4xl font-bold text-center py-10">Features</h1>
        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-10 mb-8">
          <div class="justify-items-center  border border-black rounded-3xl px-2 py-2  bg-amber-50">
            <img loading="lazy" decoding="async" width="960" height="557"
              src="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275007-1024x594.png"
              class="attachment-large size-large wp-image-1976" alt=""
              srcset="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275007-1024x594.png 1024w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275007-300x174.png 300w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275007-768x445.png 768w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275007-1536x890.png 1536w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275007-2048x1187.png 2048w"
              sizes="(max-width: 960px) 100vw, 960px">
          </div>
          <div class="justify-items-center  border border-black rounded-3xl px-2 py-2 bg-amber-50">
            <img loading="lazy" decoding="async" width="2324" height="1347"
              src="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275009-1.png"
              class="attachment-full size-full wp-image-2251" alt=""
              srcset="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275009-1.png 2324w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275009-1-300x174.png 300w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275009-1-1024x594.png 1024w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275009-1-768x445.png 768w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275009-1-1536x890.png 1536w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275009-1-2048x1187.png 2048w"
              sizes="(max-width: 2324px) 100vw, 2324px">
          </div>
        </div>
        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-10 mb-8">
          <div class="justify-items-center  border border-black rounded-3xl px-2 py-2 bg-amber-50">
            <img loading="lazy" decoding="async" width="960" height="557"
              src="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275030-1024x594.png"
              class="attachment-large size-large wp-image-2266" alt=""
              srcset="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275030-1024x594.png 1024w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275030-300x174.png 300w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275030-768x445.png 768w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275030-1536x890.png 1536w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275030-2048x1187.png 2048w"
              sizes="(max-width: 960px) 100vw, 960px">
          </div>
          <div class="justify-items-center  border border-black rounded-3xl px-2 py-2 bg-amber-50">
            <img loading="lazy" decoding="async" width="2324" height="1347"
              src="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171274990-1.png"
              class="attachment-full size-full wp-image-2265" alt=""
              srcset="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171274990-1.png 2324w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171274990-1-300x174.png 300w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171274990-1-1024x594.png 1024w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171274990-1-768x445.png 768w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171274990-1-1536x890.png 1536w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171274990-1-2048x1187.png 2048w"
              sizes="(max-width: 2324px) 100vw, 2324px">
          </div>
        </div>
        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-10 mb-8">
          <div class="justify-items-center  border border-black rounded-3xl px-2 py-2 bg-amber-50">
            <img loading="lazy" decoding="async" width="960" height="557"
              src="https://rappidx.intileotech.com/wp-content/uploads/2024/11/image-93-1-1024x594.png"
              class="attachment-large size-large wp-image-2274" alt=""
              srcset="https://rappidx.intileotech.com/wp-content/uploads/2024/11/image-93-1-1024x594.png 1024w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/image-93-1-300x174.png 300w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/image-93-1-768x445.png 768w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/image-93-1-1536x890.png 1536w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/image-93-1-2048x1187.png 2048w"
              sizes="(max-width: 960px) 100vw, 960px">
          </div>
          <div class="justify-items-center  border border-black rounded-3xl px-2 py-2 bg-amber-50">
            <img loading="lazy" decoding="async" width="2324" height="1347"
              src="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275031.png"
              class="attachment-full size-full wp-image-2275" alt=""
              srcset="https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275031.png 2324w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275031-300x174.png 300w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275031-1024x594.png 1024w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275031-768x445.png 768w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275031-1536x890.png 1536w, https://rappidx.intileotech.com/wp-content/uploads/2024/11/Group-1171275031-2048x1187.png 2048w"
              sizes="(max-width: 2324px) 100vw, 2324px">
          </div>
        </div>
      </div>
    </section> --}}

    {{-- <section class=" px-6 pb-8 container mx-auto ">
      <div class="grid grid-cols-1">
        <div class="border text-center rounded-lg bg-yellow-300">
          <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold py-10 box fadeInUp" style="animation-delay:5s;">Ship
            Anywhere, Anytime</h1>
          <p class="text-xs sm:text-sm md:text-xl text-center font-Inter text lg:px-90 md:px-12 sm:px-0 pb-6 box fadeInUp"
            style="animation-delay:5s;">Reliable
            logistics solutions tailored to your needs. Fast, secure, and hassle-free shipping worldwide.
          </p>
          <div class="pb-12 box fadeInUp" style="animation-delay:5s;">
            <button class="bg-black hover:bg-red-600 text-white  py-4 px-12 rounded-lg text-xl ">
              Sign Up Free
            </button>
          </div>
        </div>
      </div>
    </section> --}}



    <!-- Features -->
    <section class="px-6 pb-8 container mx-auto">
      <div class="grid grid-cols-1">
        <h5 class="text-2xl sm:text-3xl md:text-2xl font-bold text-center py-10">Features</h5>



        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-10 mb-8">
          <a href="https://rappidx.intileotech.com/our_solutions/" class="block">
            <div
              class="card justify-items-center border border-black rounded-3xl px-10 pt-10 bg-amber-50 hover:shadow-xl transition">
              <img src="{{ asset('img/Group-1171275007-1024x594.png') }}" alt="">
              <h6 class="font-bold text-1xl">Multi Functional Dashboard</h6>
            </div>
          </a>

          <a href="https://rappidx.intileotech.com/our_solutions/#effortless-ndr" class="block">
            <div
              class="card2 justify-items-center border border-black rounded-3xl px-10 pt-10 bg-amber-50 hover:shadow-xl transition">
              <img src="{{ asset('img/Group-1171275009-1-2048x1187.png') }}" alt="">
              <h1 class="font-bold text-1xl">Effortless NDR Management</h1>
            </div>
          </a>
        </div>

        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-10 mb-8">
          <a href="https://rappidx.intileotech.com/our_solutions/#api-integration" class="block">
            <div
              class="card justify-items-center border border-black rounded-3xl px-10 pt-10 bg-amber-50 hover:shadow-xl transition">
              <img src="{{ asset('img/Group-1171275030-1024x594.png') }}" alt="">
              <h1 class="font-bold text-1xl">API Integration & Multi channel Plugins</h1>
            </div>
          </a>

          <a href="https://rappidx.intileotech.com/our_solutions/#dedicated-support" class="block">
            <div
              class="card2 justify-items-center border border-black rounded-3xl px-10 pt-10 bg-amber-50 hover:shadow-xl transition">
              <img src="{{ asset('img/Group-1171274990-1-2048x1187.png') }}" alt="">
              <h1 class="font-bold text-1xl">Best-In-Class Customer Support with a Dedicated Team</h1>
            </div>
          </a>
        </div>

        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-10 mb-8">
          <a href="https://rappidx.intileotech.com/our_solutions/#ai-powered" class="block">
            <div
              class="card justify-items-center border border-black rounded-3xl px-10 pt-10 bg-amber-50 hover:shadow-xl transition">
              <img src="{{ asset('img/image-93-1-1024x594.png') }}" alt="">
              <h1 class="font-bold text-1xl">AI Powered Courier Selection</h1>
            </div>
          </a>

          <a href="https://rappidx.intileotech.com/our_solutions/#branded-tracking" class="block">
            <div
              class="card2 justify-items-center border border-black rounded-3xl px-10 pt-10 bg-amber-50 hover:shadow-xl transition">
              <img src="{{ asset('img/Group-1171275031-2048x1187.png') }}" alt="">
              <h1 class="font-bold text-1xl">Branded Tracking Page</h1>
            </div>
          </a>
        </div>
      </div>
    </section>
  </main>


  <script>
    function toggleTailwindPassword() {
      const input = document.getElementById("password");
      const icon = document.getElementById("tailwindToggleIcon");

      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>
  <script>
    // Hide alert messages after 30 seconds (30000 ms)
    setTimeout(function () {
      document.querySelectorAll('.auto-hide').forEach(function (el) {
        el.style.display = 'none';
      });
    }, 3000); // 30,000 milliseconds = 30 seconds
  </script>

  <script>
    const mobile_icon = document.getElementById('mobile-icon');
    const mobile_menu = document.getElementById('mobile-menu');
    const hamburger_icon = document.querySelector("#mobile-icon i");

    function openCloseMenu() {
      mobile_menu.classList.toggle('block');
      mobile_menu.classList.toggle('active');
    }

    function changeIcon(icon) {
      icon.classList.toggle("fa-xmark");
    }
    mobile_icon.addEventListener('click', openCloseMenu);
    // -----------------
  </script>
  <!-- Script mejorado -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://unpkg.com/@material-tailwind/html@3.0.0-beta.7/dist/material-tailwind.umd.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./main.js"></script>
</body>

</html>