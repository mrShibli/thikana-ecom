@extends('clientside.app.app')
@section('client-content')
    <div class="container mx-auto p-3 laptop:py-10">
        <h1 class="text-xl laptop:text-2xl text-blue text-center py-4">Checkout</h1>
        <div class="divider border mb-4 laptop:mb-8"></div>

        <form id="order-form">
            @csrf
            <div class="flex flex-wrap gap-4">

                <div class="laptop:w-1/2 border rounded p-2 laptop:p-4">
                    <h2 class="text-xl font-semibold mb-3">Billing details</h2>

                    {{-- Name --}}
                    <div class="mb-3">
                        <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                            type="text" name="name" placeholder="আপনার নাম লিখুন" id=""
                            value="{{ auth()->check() ? auth()->user()->name : old('name') }}">
                        @if ($errors->get('name'))
                            <div class="font-light text-red-900 px-1">
                                @foreach ($errors->get('name') as $error)
                                    <small>{{ $error }}</small>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                            type="text" name="address"
                            placeholder="যেখানে ডেলিভারি নিবেন তা লিখুন যেমনঃ হোল্ডিং/গ্রাম/বাজার" id=""
                            value="{{ auth()->check() ? auth()->user()->address : old('address') }}">
                        @if ($errors->get('address'))
                            <div class="font-light text-red-900 px-1">
                                @foreach ($errors->get('address') as $error)
                                    <small>{{ $error }}</small>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Upazila --}}
                    <div class="mb-3">
                        <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                            type="text" name="upazila" placeholder="আপনার থানা (পুলিশ স্টেশন) লিখুন" id=""
                            value="{{ auth()->check() ? auth()->user()->upazila : old('upazila') }}">
                        @if ($errors->get('upazila'))
                            <div class="font-light text-red-900 px-1">
                                @foreach ($errors->get('upazila') as $error)
                                    <small>{{ $error }}</small>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- City --}}
                    <div class="mb-3">
                        <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                            type="text" name="city" placeholder="আপনার জেলা লিখুন" id=""
                            value="{{ auth()->check() ? auth()->user()->city : old('city') }}">
                        @if ($errors->get('city'))
                            <div class="font-light text-red-900 px-1">
                                @foreach ($errors->get('city') as $error)
                                    <small>{{ $error }}</small>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3">
                        <input class="w-full p-1 pl-2  placeholder:text-xs placeholder:text-[#666666] border rounded"
                            type="tel" name="phone" placeholder="আপনার মোবাইল নাম্বার লিখুন" id=""
                            value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}">
                        @if ($errors->get('phone'))
                            <div class="font-light text-red-900 px-1">
                                @foreach ($errors->get('phone') as $error)
                                    <small>{{ $error }}</small>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <h5 class="text-xs laptop:text-sm my-5">প্রিয়জন কে চিরকুট দিতে আপনার Message এখানে লিখুন</h5>

                    <label class="block mb-2 text-sm text-gray-500" for="">Order notes (optional)</label>
                    <textarea class="w-full p-1 pl-2 mb-2 placeholder:text-xs placeholder:text-[#666666] border rounded h-32 laptop:h-40 "
                        name="message" id="" cols="30" rows="8"></textarea>

                </div>

                <div class="laptop:w-[40%] border rounded p-4 ">

                    <div id="cart-table" class="mb-4">
                        <h2 class="mb-5 text-xl font-semibold ">Your order</h2>
                        <table class="flex  justify-center">

                            <tr class="border  border-black">
                                <th class="border border-black p-2 px-4 text-sm">Product</th>
                                <th class="border border-black p-2 px-4 text-sm">Subtotal</th>
                            </tr>
                            @foreach ($carts as $cart)
                                <tr>
                                    @php
                                        $slug = strtolower(
                                            trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cart->product->title)),
                                        );
                                    @endphp
                                    <td class="border border-black  p-2 px-4 text-xs" id="p-title">
                                        <a
                                            href="{{ route('product.single', ['id' => $cart->product->id, 'slug' => $slug]) }}">
                                            {{ $cart->product->title }} X {{ $cart->qunt }}
                                        </a>
                                    </td>
                                    <td class="border border-black p-2 px-4 text-xs" id="p-price">
                                        {{ $cart->price * $cart->qunt }}৳
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td class="border border-black p-2 px-4 text-xs">Subtotal</td>
                                <td class="border border-black p-2 px-4 text-xs" id="Subtotal">{{ $sub_total }}৳</td>
                            </tr>

                            <tr>
                                <td class="border border-black p-2 px-4 text-xs">Shipping</td>
                                <td class="border border-black p-2 px-4 text-xs" id="flat-rate">Flat rate: 70৳</td>
                            </tr>

                            <tr>
                                <td class="border border-black p-2 px-4 text-xs"> Total</td>
                                <td class="border border-black p-2 px-4 text-xs" id="flat-rate">
                                    {{ $sub_total + 70 }}৳
                                </td>
                            </tr>

                        </table>
                    </div>

                    {{-- <div class="bg-[#E9E6ED] p-3 rounded">
                    <h5 class="text-sm mb-4">Cash on delivery</h5>
                    <p class="text-sm bg-[#DCD7E3] p-3 rounded">Product হাতে পেয়ে মুল্য পরিশোধ করুন।</p>
                    <div class="divider border border-gray-300 my-4"></div>
                    <p class="text-xs">Your personal data will be used to process your order, support your experience
                        throughout this website, and for other purposes described in our privacy policy.</p>
                    <button type="submit"
                       class="block py-3 px-3 fw-bold text-white bg-[#7F54B3] hover:bg-[#7249A4] rounded text-center mt-3 text-xs">অর্ডার Confirm করুন</button>
                </div> --}}

                    <!-- Payment Options -->
                    <div class="bg-[#E9E6ED] p-3 rounded">
                        <h5 class="text-sm mb-4">Payment Method</h5>
                        <div>
                            <!-- Cash on Delivery -->
                            <div class="mb-2">
                                <input type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label for="cod" class="text-sm">Cash on Delivery</label>
                            </div>
                            <!-- Credit Card -->
                            {{-- <div class="mb-2">
                                <input type="radio" name="payment_method" id="credit_card" value="credit_card">
                                <label for="credit_card" class="text-sm">Credit Card</label>
                            </div> --}}
                            <!-- Bkash -->
                            {{-- <div class="mb-2">
                                <input type="radio" name="payment_method" id="bkash" value="bkash">
                                <label for="bkash" class="text-sm">Bkash</label>
                            </div> --}}
                            <!-- Add more payment methods as needed -->
                        </div>
                        <div class="divider border border-gray-300 my-4"></div>
                        <p class="text-xs">
                            Your personal data will be used to process your order, support your experience throughout this
                            website, and for other purposes described in our privacy policy.
                        </p>
                        <button type="submit"
                            class="block py-3 px-3 fw-bold text-white bg-[#7F54B3] hover:bg-[#7249A4] rounded text-center mt-3 text-xs">
                            অর্ডার Confirm করুন
                        </button>
                    </div>


                </div>

            </div>

        </form>

        <!-- OTP Verification Modal -->
        <div id="otpModal" class="fixed inset-0 z-50 hidden bg-gray-600 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <div class="flex justify-between items-center">
                    <h5 class="text-xl font-semibold">Mobile Verification</h5>
                    <button type="button" class="text-gray-600 hover:text-gray-800" onclick="closeOtpModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="mt-4">
                    <form id="otp-form">
                        <div class="mb-4">
                            <label for="otp" class="block text-sm font-medium text-gray-700">Enter OTP</label>
                            <input type="text"
                                class="w-full p-2 mt-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                id="otp" name="otp" maxlength="4" required>
                        </div>
                        <div class="mb-4">
                            <button type="submit"
                                class="w-full bg-indigo-600 text-white p-2 rounded-md hover:bg-indigo-700">Verify
                                OTP</button>
                            <button type="button"
                                class="w-full bg-blue text-white p-2 rounded-md hover:bg-indigo-700 mt-1 mb-1 resendotp">Resend
                                OTP</button>
                        </div>
                        <div id="otp-message"></div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Include a section for messages -->
        <div id="order-message" class="mt-4"></div>

    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#order-form').on('submit', function(e) {
                e.preventDefault();
                placeOrder(); // Call placeOrder when the form is submitted
            });

            function placeOrder() {
                $.ajax({
                    url: '{{ route('order.store') }}', // URL to send the order data to
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    data: $('#order-form').serialize(), // Serialize form data to send as POST data
                    success: function(data) {
                        if (data.status === 'otp_sent') {
                            // Handle the specific COD test message
                            openOtpModal(); // Make sure the modal is shown after OTP is sent
                            $('#order-message').html(`
                            <div class="p-3 bg-yellow-500 text-white rounded">
                                ${data.message}  <!-- Show message for COD payment method -->
                            </div>
                        `);
                        } else if (data.success) {
                            $('#order-message').html(`
                            <div class="p-3 bg-green-500 text-white rounded">
                                ${data.message}  <!-- Show success message -->
                            </div>
                        `);

                            // Check if order_id is available
                            if (data.order_id) {
                                // Redirect to the thank you page with order ID
                                setTimeout(function() {
                                    window.location.href = "{{ url('thank-you') }}/" + data
                                        .order_id; // Ensure order_id is appended
                                }, 1000); // 2 seconds before redirecting
                            } else {
                                console.log("Order ID not received");
                            }

                            $('#order-form')[0].reset(); // Clear form after success (optional)
                        } else {
                            // Display errors returned by the backend
                            let errorMessages = Array.isArray(data.errors) ? data.errors.join('<br>') :
                                'Unknown error';
                            $('#order-message').html(`
                            <div class="p-3 bg-red-500 text-white rounded">
                                ${errorMessages}  <!-- Show error message -->
                            </div>
                        `);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Log the full response for debugging
                        console.log('XHR:', xhr); // Log full error response for debugging
                        console.log('Status:', status); // Log status
                        console.log('Error:', error); // Log error message

                        if (xhr.status === 422) {
                            // Handle validation errors specifically
                            let errorMessages = '';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                let errors = xhr.responseJSON.errors;
                                for (let field in errors) {
                                    errorMessages += errors[field].join('<br>');
                                }
                            } else {
                                errorMessages = 'There were some validation issues with your order.';
                            }
                            $('#order-message').html(`
                            <div class="p-3 bg-red-500 text-white rounded">
                                ${errorMessages}  <!-- Show validation error messages -->
                            </div>
                        `);
                        } else {
                            // Generic error handling for other types of errors
                            $('#order-message').html(`
                            <div class="p-3 bg-red-500 text-white rounded">
                                An unexpected error occurred: ${error}. Please try again.
                            </div>
                        `);
                        }
                    }
                });
            }

        });
    </script>

    <script>
        // Function to open the OTP modal
        function openOtpModal() {
            document.getElementById('otpModal').classList.remove('hidden');
        }

        // Function to close the OTP modal
        function closeOtpModal() {
            document.getElementById('otpModal').classList.add('hidden');
        }

        // Handle OTP form submission
        $('#otpModal').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            submitOtp(e); // Pass the event 'e' to the submitOtp function
        });

        // Function to handle OTP form submission
        function submitOtp(e) {
            e.preventDefault(); // Prevent default form submission

            var otp = document.getElementById('otp').value;

            $.ajax({
                url: '{{ route('otp.verify') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    otp: otp
                },
                success: function(response) {
                    console.log('OTP verification response:', response); // Log response for debugging

                    if (response.status === 'success') {
                        $('#order-message').html(
                            '<div class="p-3 bg-green-500 text-white rounded">OTP verified successfully!</div>'
                        );

                        closeOtpModal();
                        // Redirect to the Thank You page after 1 second

                        // Check if order_id is available
                        if (response.order_id) {
                            // Redirect to the thank you page with order ID
                            setTimeout(function() {
                                window.location.href = "{{ url('thank-you') }}/" + response.order_id; // Ensure order_id is appended
                            }, 1000); // 2 seconds before redirecting
                        } else {
                            console.log("Order ID not received");
                        }

                    } else {
                        $('#otp-message').html(
                            '<div class="p-3 bg-red-500 text-white rounded">' + xhr.responseJSON.message +
                            '</div>'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error); // Log error for debugging

                    if (xhr.status === 400) {
                        // If the backend returns an error response (invalid OTP)
                        $('#otp-message').html(
                            '<div class="p-3 bg-red-500 text-white rounded">' + xhr.responseJSON.message +
                            '</div>'
                        );
                    } else {
                        $('#otp-message').html(
                            '<div class="p-3 bg-red-500 text-white rounded">An unexpected error occurred. Please try again.</div>'
                        );
                    }
                }
            });
        }

        // Function to handle Resend OTP button click
        $(document).on('click', '.resendotp', function() {
            var resendButton = $(this);

            // Disable the button and start the countdown
            disableResendButton(resendButton, 30);

            // Make the AJAX call to resend the OTP
            $.ajax({
                url: '{{ route('otp.resend') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#otp-message').html(
                            '<div class="p-3 bg-green-500 text-white rounded">OTP resent successfully!</div>'
                        );
                    } else {
                        $('#otp-message').html(
                            '<div class="p-3 bg-red-500 text-white rounded">' + response.message +
                            '</div>'
                        );
                    }
                },
                error: function(xhr) {
                    $('#otp-message').html(
                        '<div class="p-3 bg-red-500 text-white rounded">' +
                        (xhr.responseJSON?.message || 'An error occurred while resending OTP.') +
                        '</div>'
                    );
                }
            });
        });

        // Function to disable the Resend OTP button with a countdown
        function disableResendButton(button, seconds) {
            button.prop('disabled', true); // Disable the button
            var originalText = button.text(); // Save the original button text

            var interval = setInterval(function() {
                if (seconds > 0) {
                    button.text('Resend in ' + seconds + 's'); // Update button text with countdown
                    seconds--;
                } else {
                    clearInterval(interval); // Clear the interval when countdown ends
                    button.prop('disabled', false); // Re-enable the button
                    button.text('Resend OTP'); // Restore original button text
                }
            }, 1000); // Update every second
        }
    </script>
@endsection
