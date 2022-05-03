<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>

<body class="bg-pink-200">
    @include('../header')
    <div class="bg-white mt-6 pt-8 pb-4 pl-9 pr-9 mx-40 rounded-lg">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- FirstName -->
            <div>
                <x-label class="ml-5" for="first_name" :value="__('FirstName')" />

                <x-input id="first_name" class="block mt-1 w-full rounded-lg border-2" type="text" name="firstName"
                    :value="old('firstName')" required autofocus />
            </div>

            <!-- LastName -->
            <div class="mt-4">
                <x-label class="ml-5" for="last_name" :value="__('LastName')" />

                <x-input id="last_name" class="block mt-1 w-full rounded-lg border-2" type="text" name="lastName"
                    :value="old('lastName')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label class="ml-5" for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full rounded-lg border-2" type="email" name="email"
                    :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label class="ml-5" for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full rounded-lg border-2" type="password" name="password"
                    required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label class="ml-5" for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-2" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-8">
                <a class="underline text-sm text-black hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 bg-black">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </div>
</body>

</html>
