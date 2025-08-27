<x-botique>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white rounded-2xl shadow-lg flex flex-col sm:flex-row max-w-3xl w-full overflow-hidden">
        <!-- Left side: Forgot Password Form -->
        <div class="relative w-full md:w-1/2 p-8 flex flex-col justify-center">
            <!-- Logo -->
            <img src="{{ asset('storage/images/sewing.png') }}" 
                 alt="Boutique" 
                 class="h-12 w-auto object-contain absolute top-4 left-4 rounded-2xl">

            <!-- Title -->
            <div class="text-2xl font-bold mb-6 text-center mt-12">Reset Password</div>
            
            @if (session('status'))
                <div class="p-4 mb-4 text-base text-blue-800 bg-white rounded-lg bg-green-50 mb-4 font-bold" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 bg-white rounded-lg bg-red-50" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full border-gray-300 rounded-sm shadow-sm p-2">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                    {{ __('Email Password Reset Link') }}
                </button>

                <!-- Back to Login -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white btn">
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
</x-botique>
