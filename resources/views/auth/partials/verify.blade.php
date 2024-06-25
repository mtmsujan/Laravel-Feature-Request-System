<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

    {{-- Confrim Modal --}}
    <div class="flex justify-between p-4 md:p-5 rounded-t ">
        <div>
            <h3 class="text-xl font-medium text-black">
                Confirm
            </h3>
            <p class="text-xs leading-relaxed text-black">
                We have sent you a four-digit verification code via email. Please enter this code below.
            </p>
        </div>
        <button type="button"
            class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-black"
            data-modal-hide="top-left-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Modal body -->
    <div class="p-4 md:p-5 space-y-4 relative">
        <form id="code-form" action="{{route('user.verify.store')}}" method="POST" class="verify-container flex justify-center">
            @csrf
            <input autofocus
                class="code-input block m-2 leading-10 text-center rounded border-0 text-lg bg-gray-200 w-10 text-black placeholder:text-black"
                type="text" name="code[]" inputmode="numeric" pattern="[0-9]*" maxlength="1" placeholder="·">
            <input
                class="code-input block m-2 leading-10 text-center rounded border-0 text-lg bg-gray-200 w-10 text-black placeholder:text-black"
                type="text" name="code[]" inputmode="numeric" pattern="[0-9]*" maxlength="1" placeholder="·">
            <input
                class="code-input block m-2 leading-10 text-center rounded border-0 text-lg bg-gray-200 w-10 text-black placeholder:text-black"
                type="text" name="code[]" inputmode="numeric" pattern="[0-9]*" maxlength="1" placeholder="·">
            <input
                class="code-input block m-2 leading-10 text-center rounded border-0 text-lg bg-gray-200 w-10 text-black placeholder:text-black"
                type="text" name="code[]" inputmode="numeric" pattern="[0-9]*" maxlength="1" placeholder="·">
        </form>
        <div class="verify-resend flex justify-center gap-2 text-xs text-black">
            <div id="countdown">The verificatin code will expires in 5:00 minutes</div>
            <a id="resend-link" class="cursor-pointer hidden underline">Resend Code</a>
        </div>
    </div>
</div>

<script id="counter-script" hx-swap-oob="true">
    $(document).ready(function() {
        var countdown = 5 * 60; // 5 minutes in seconds
        var timer = setInterval(function() {
            var minutes = Math.floor(countdown / 60);
            var seconds = countdown % 60;
            $('#countdown').text("The verificatin code will expires in " + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + " minutes");

            if (countdown == 0) {
                clearInterval(timer);
                // You can add any action you want when the countdown reaches zero
                $('#countdown').html('<span class="text-rose-500">Code expired!</span>');
                $('#resend-link').props('href', '{{route("user.verify")}}').show()
            } else {
                countdown--;
            }
        }, 1000); // Update every second

        let codeInputs = $('.code-input')

        codeInputs.each((i, code)=>{
            $(code).on('keyup', ()=>{
                if (i != (codeInputs.length - 1)) {
                    $(code).next().focus()
                }else{
                    $('#code-form').submit()
                }
            })
        })
    })
</script>
