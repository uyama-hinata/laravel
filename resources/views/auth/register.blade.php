<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- LastName -->
        <div>
            <x-input-label for="LastName" :value="__('LastName')" />
            <x-text-input id="LastName" class="block mt-1 w-full" type="text" name="LastName" :value="old('LastName')" required autofocus autocomplete="LastName" />
            <x-input-error :messages="$errors->get('LastName')" class="mt-2" />
        </div>

        <!-- FirstName -->
        <div>
            <x-input-label for="FirstName" :value="__('FirstName')" />
            <x-text-input id="FirstName" class="block mt-1 w-full" type="text" name="FirstName" :value="old('FirstName')" required autofocus autocomplete="FirstName" />
            <x-input-error :messages="$errors->get('FirstName')" class="mt-2" />
        </div>

        <!-- NickName-->
        <div>
            <x-input-label for="NickName" :value="__('NickName')" />
            <x-text-input id="NickName" class="block mt-1 w-full" type="text" name="NickName" :value="old('NickName')" required autofocus autocomplete="NickName" />
            <x-input-error :messages="$errors->get('NickName')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div>
            <x-input-label for="Gender1" :value="__('Male')" />
                <input  class⁼ type="radio" name="Gender" id="Gender1" value="1" {{old('Gender') == 1 ? 'checked' : ''}} required autofocus autocomplete="Gender" />
            <x-input-label for="Gender2" :value="__('Female')" />
                <input  type="radio" name="Gender" id="Gender2" value="2" {{old('Gender') == 2 ? 'checked' : ''}} required autofocus autocomplete="Gender" />
            <x-input-error :messages="$errors->get('Gender')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
