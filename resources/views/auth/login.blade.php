<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--bm-cream) 0%, #F5F2ED 100%);">
        <div class="w-full max-w-md">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/breads/logo192.png') }}" alt="Bánh Mì Shop Logo" class="mx-auto w-24 h-24 mb-4">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Bánh Mì Shop</h1>
                <p class="text-gray-600">Đăng nhập vào tài khoản của bạn</p>
            </div>

            <!-- Login Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')"
                            required 
                            autofocus 
                            autocomplete="username"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-0 transition"
                            style="focus:ring-color: var(--bm-golden);"
                            placeholder="your@email.com"
                        />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password"
                            required 
                            autocomplete="current-password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition"
                            style="focus:ring-color: var(--bm-golden);"
                            placeholder="••••••••"
                        />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Session Status -->
                    @if ($errors->any())
                        <div class="p-4 rounded-lg bg-red-50 border border-red-200">
                            <p class="text-sm text-red-600">{{ $errors->first() }}</p>
                        </div>
                    @endif

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember"
                            class="rounded border-gray-300"
                        />
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">Nhớ tôi</label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3 rounded-lg font-medium text-white transition-all"
                        style="background-color: var(--bm-golden);"
                    >
                        Đăng nhập
                    </button>
                </form>

                <!-- Links -->
                <div class="mt-6 space-y-3 text-center text-sm">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-gray-600 hover:text-gray-900">
                            Quên mật khẩu?
                        </a> <br/>
                    @endif
                    <p class="text-gray-600">
                        Chưa có tài khoản? 
                        <a href="{{ route('register') }}" class="font-semibold" style="color: var(--bm-golden);">Đăng ký ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
