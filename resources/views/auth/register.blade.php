<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- First name -->
        <div>
            <x-input-label for="first_name" :value="__('Prénom')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

         <!-- CNI -->
         <div>
            <x-input-label for="cni" :value="__('Carte nationale d\'identité')" />
            <x-text-input id="cni" class="block mt-1 w-full" type="text" name="cni" :value="old('cni')" autofocus autocomplete="cni" />
            <x-input-error :messages="$errors->get('cni')" class="mt-2" />
        </div>

        <!-- Heure début -->
        <div class="mt-4">
            <x-input-label for="heure_debut" :value="__('Heure début')" />
            <x-text-input id="heure_debut" class="block mt-1 w-full" type="text" name="heure_debut" :value="old('heure_debut')" autocomplete="heure_debut" />
            <x-input-error :messages="$errors->get('heure_debut')" class="mt-2" />
        </div>

         <!-- Heure fin -->
         <div class="mt-4">
            <x-input-label for="heure_fin" :value="__('Heure fin')" />
            <x-text-input id="heure_fin" class="block mt-1 w-full" type="text" name="heure_fin" :value="old('heure_fin')" autocomplete="heure_fin" />
            <x-input-error :messages="$errors->get('heure_fin')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                         autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- CMJ -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Coût journalier moyen')" />
            <x-text-input id="cjm" class="block mt-1 w-full" type="text" name="cjm" autocomplete="cjm" />
            <x-input-error :messages="$errors->get('cjm')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full">
                <option value=""> Quel type de compte créez vous ?</option>
                <option value="1">Admninistrateur</option>
                <option value="2">Salarié</option>
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4" type="submit">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script src="/assets/js/controlForm.js"></script>