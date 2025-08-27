<x-botique>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white rounded-2xl shadow-lg flex flex-col sm:flex-row max-w-3xl w-full overflow-hidden">
        <!-- Left side: Reset Password Form -->
        <div class="relative w-full md:w-1/2 p-8 flex flex-col justify-center">
            <!-- Logo -->
            <img src="{{ asset('storage/images/sewing.png') }}" 
                 alt="Boutique" 
                 class="h-12 w-auto object-contain absolute top-4 left-4 rounded-2xl">

            <!-- Title -->
            <div class="text-2xl font-bold mb-6 text-center mt-12">Reset Password</div>
            
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 bg-white rounded-lg bg-red-50" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" 
                           required autofocus autocomplete="username"
                           class="mt-1 block w-full border-gray-300 rounded-sm shadow-sm p-2">
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium">New Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="mt-1 block w-full border-gray-300 rounded-sm shadow-sm p-2">
                        <i id="togglePassword"
                           class="fa-solid fa-eye-slash absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500 pt-2"></i>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="relative">
                    <label for="password_confirmation" class="block text-sm font-medium">Confirm New Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               required autocomplete="new-password"
                               class="mt-1 block w-full border-gray-300 rounded-sm shadow-sm p-2">
                        <i id="toggleConfirmPassword"
                           class="fa-solid fa-eye-slash absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500 pt-2"></i>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 mt-4">
                    {{ __('Reset Password') }}
                </button>

                <!-- Back to Login -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Back to login
                    </a>
                </div>
            </form>
        </div>

        <!-- Right side: Image (hidden on small screens) -->
        <div class="hidden sm:flex w-full md:w-1/2 justify-center items-center p-8">
            <img src="{{ asset('storage/images/sewing.png') }}" alt="Boutique" 
                 class="max-w-xs w-full object-contain rounded-lg shadow">
        </div>
    </div>
</div>

<!-- Toggle Password Visibility Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#password_confirmation');

        togglePassword?.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword?.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
</x-botique>
