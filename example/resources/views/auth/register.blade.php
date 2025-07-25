<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>
    <form method="POST" action="/register">
        @csrf 

            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <x-form-field>
                  <x-form-label for="first_name">First Name</x-form-label>
                <div class="mt-2">

                    <x-form-input name="first_name" id="first_Name" required/>
                  
                    <x-form-error name="first_name" />

                </div>
              </x-form-field>

              <x-form-field>
                <x-form-label for="last_name">Last Name</x-form-label>
              <div class="mt-2">

                  <x-form-input name="last_name" id="last_name" required/>
                
                  <x-form-error name="last_name" />

              </div>
            </x-form-field>

            <x-form-field>
                <x-form-label for="email">Email</x-form-label>
              <div class="mt-2">

                  <x-form-input name="email" id="email" type="email" required/>
                
                  <x-form-error name="email" />

              </div>
            </x-form-field>

            <x-form-field>
                <x-form-label for="password">Password</x-form-label>
              <div class="mt-2">

                  <x-form-input name="password" id="password" type="password" required/>
                  <x-form-error name="password" required/>

              </div>
            </x-form-field>

            <x-form-field>
                <x-form-label for="password_confirmation">Confirm Password</x-form-label>
              <div class="mt-2">

                  <x-form-input name="password_confirmation" id="password_confirmation" type="password" required/>
                  <x-form-error name="password_confirmation" />

              </div>
            </x-form-field>
      
                <div>
                    @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-red-500 italic">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                </div>

            </div>
        </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="/" class="text-sm font-semibold text-gray-900">Cancel</button>
          <x-form-button>Register</x-form-button>
        </div>
      </form>
      
</x-layout>