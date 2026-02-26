<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--bm-cream) 0%, #F5F2ED 100%);">
        <div class="w-full max-w-md">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/breads/logo192.png') }}" alt="Bánh Mì Shop Logo" class="mx-auto w-24 h-24 mb-4">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Bánh Mì Shop</h1>
                <p class="text-gray-600">Tạo tài khoản mới</p>
            </div>

            <!-- Register Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Họ và Tên</label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            :value="old('name')"
                            required 
                            autofocus 
                            autocomplete="name"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition"
                            placeholder="Nguyễn Văn A"
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')"
                            required 
                            autocomplete="username"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition"
                            placeholder="your@email.com"
                        />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                        <input 
                            id="phone" 
                            type="text" 
                            name="phone" 
                            :value="old('phone')"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition"
                            placeholder="0123456789"
                        />
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Địa chỉ</label>
                        <textarea 
                            id="address" 
                            name="address" 
                            rows="2"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition"
                            placeholder="Nhập địa chỉ của bạn"
                        >{{ old('address') }}</textarea>
                        @error('address')
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
                            autocomplete="new-password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition"
                            placeholder="••••••••"
                        />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu</label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation"
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition"
                            placeholder="••••••••"
                        />
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3 rounded-lg font-medium text-white transition-all mt-6"
                        style="background-color: var(--bm-golden);"
                    >
                        Đăng ký
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-600">
                        Đã có tài khoản? 
                        <a href="{{ route('login') }}" class="font-semibold" style="color: var(--bm-golden);">Đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>