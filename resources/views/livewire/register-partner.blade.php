<div class="mt-6">
    <form action="{{ route("register") }}" method="POST" class="inline-block" x-data="slides()" x-effect="bindSecondSlide" x-init="$nextTick(() => checkErrors())">
        @csrf
        <div :class="slide > 1 ? '!visible' :'invisible'" @click="changeSlide(-1)" class="cursor-pointer my-2 hover:bg-gray-200 p-1 inline-block rounded-md" style="visibility: hidden">
            <svg class="h-8 w-8 text-gray-700"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
        </div>
        <div 
            class="first-step" 
            x-show="isActive(1)" 
            x-transition:enter="transition ease-in-out duration-300 delay-300 will-change-transform"
            x-transition:enter-start="opacity-0 transform -translate-x-1/2" 
            x-transition:enter-end="opacity-100 h-0 transform translate-x-0" 
            x-transition:leave="transition ease-in-out duration-300 will-change-transform" 
            x-transition:leave-start="opacity-100 transform translate-x-0" 
            x-transition:leave-end="opacity-0 transform -translate-x-1/2" 
        >
            <h1 class="text-3xl font-bold">Create a partner account</h1>
            <h3 class="mt-2">Create an account to list and manage your property.</h3>
            <div class="mt-6">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                <input name="email" value="{{ old("email") }}" x-ref="email" type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                @error("email")
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="12" y1="16" x2="12" y2="12" />  <line x1="12" y1="8" x2="12.01" y2="8" /></svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror
                <button class="bg-blue-600 w-full p-3 mt-2 hover:bg-blue-500 transition text-white rounded-sm" @click="changeSlide(1)">Next</button>
            </div>
            <div class="border border-t border-t-gray-300 my-6"></div>
            <div>
                <h1 class="text-center">Already have an account?</h1>
                <a href="/partner/login" class="bg-white border border-blue-600 hover:border-blue-500 hover:text-blue-500 transition mt-3 p-3 w-full block text-center text-blue-600 rounded-sm">Sign in</a>
            </div>
        </div>
        <div 
            class="second-step"
            x-show="isActive(2)"
            x-ref="secondSlide"
            x-transition:enter="transition ease-in-out duration-300 delay-300 will-change-transform" 
            x-transition:leave="transition ease-in-out duration-300 will-change-transform"
        >
            <h1 class="text-3xl font-bold">Contact details</h1>
            <h3 class="mt-2">Your full name is needed for registering your properties.</h3>
            <div class="mt-6">
                <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First name</label>
                <input name="name" x-ref="name" value="{{ old("name") }}" type="text" id="full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                
                <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last name</label>
                <input name="lastname" x-ref="lastname" value="{{ old("lastname") }}" type="text" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                
                @error("name")
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="12" y1="16" x2="12" y2="12" />  <line x1="12" y1="8" x2="12.01" y2="8" /></svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror

                <button class="bg-blue-600 w-full p-3 mt-2 hover:bg-blue-500 transition text-white rounded-sm" @click="changeSlide(1)">Next</button>
            </div>
        </div>
        <div
            class="third-step" 
            x-show="isActive(3)" 
            x-transition:enter="transition ease-in-out duration-300 delay-300 will-change-transform" 
            x-transition:enter-start="opacity-0 transform translate-x-1/2" 
            x-transition:enter-end="opacity-100 h-0 transform translate-x-0 h-0" 
            x-transition:leave="transition ease-in-out duration-300 will-change-transform" 
            x-transition:leave-start="opacity-100 transform translate-x-0" 
            x-transition:leave-end="opacity-0 transform translate-x-1/2"
        >
            <h1 class="text-3xl font-bold">Create password</h1>
            <h3 class="mt-2">Use a minimum of 8 characters, including uppercase letters, lowercase letters, and numbers.</h3>
            <div class="mt-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                <input name="password" x-ref="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm password</label>
                <input name="password_confirmation" x-ref="" type="password" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                @error("password")
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="12" y1="16" x2="12" y2="12" />  <line x1="12" y1="8" x2="12.01" y2="8" /></svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror
                <button class="bg-blue-600 w-full p-3 mt-2 hover:bg-blue-500 transition text-white rounded-sm" type="submit">Create account</button>
            </div>
        </div>
        <input type="hidden" name="role" value="partner">
        <input type="hidden" x-ref="errors" value="{{ json_encode($errors->all()) }}" >
    </form>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("slides", () => ({
                slide: 1,
                oldAmount: 1,
                errors: [],
                isActive(index) {
                    return this.slide == index;
                },
                checkErrors(){
                    this.errors = JSON.parse(this.$refs.errors.value);

                    if(this.errors.length > 0) {
                        const getSlide = this.getErrorSlide();

                        for(let i = 1; i <= getSlide; i++) {
                            this.$nextTick(() => {
                                this.slide = i;
                            })
                        }

                        this.oldAmount = -1;
                        this.bindSecondSlide();
                    }
                },
                getErrorSlide(){
                    const firstError = this.errors[0];

                    if(firstError.includes("email")) {
                        return 1;
                    } else if(firstError.includes("password")) {
                        return 3;
                    } else {
                        return 2;
                    }
                },
                changeSlide(amount) {
                    if(amount == 1) {
                        if(!this.validateFields()){
                            return;
                        }
                    }

                    if(this.slide == 1 && amount > 0 || this.slide == 2 && amount < 0) {
                        this.oldAmount = 1;
                    } else if(this.slide == 2 && amount > 0) {
                        this.oldAmount = -1;
                    }
                    
                    this.bindSecondSlide();
                    
                    this.$nextTick(() => {
                        this.slide = this.slide + (amount);
                    });
                },
                validateFields() {
                    switch (this.slide) {
                        case 1:
                            if(this.$refs.email.value.trim() == "") {
                                return false;
                            } 
                            return true;
                            break;
                        case 2:
                            if(this.$refs.name.value.trim() == "" || this.$refs.lastname.value.trim() == "") {
                                return false
                            }
                            return true;
                            break;
                        case 3:
                            if(this.$refs.password.value.trim() == "" || this.$refs.password_confirmation.value.trim() == "") {
                                return false;
                            }
                            return true;
                            break;
                        default:
                            return true;
                            break;
                    }
                },
                bindSecondSlide() {
                    const secondSlide = this.$refs.secondSlide;
                    secondSlide.removeAttribute("x-transition:enter-start");
                    secondSlide.removeAttribute("x-transition:enter-end");
                    secondSlide.removeAttribute("x-transition:leave-start");
                    secondSlide.removeAttribute("x-transition:leave-end");

                    if(this.oldAmount > 0) {
                        secondSlide.setAttribute("x-transition:enter-start", "opacity-0 transform translate-x-1/2");
                        secondSlide.setAttribute("x-transition:enter-end", "opacity-100 h-0 transform translate-x-0");
                        secondSlide.setAttribute("x-transition:leave-start", "opacity-100 transform translate-x-0");
                        secondSlide.setAttribute("x-transition:leave-end", "opacity-0 transform translate-x-1/2");
                    } else {
                        secondSlide.setAttribute("x-transition:enter-start", "opacity-0 transform -translate-x-1/2");
                        secondSlide.setAttribute("x-transition:enter-end", "opacity-100 transform h-0 translate-x-0");
                        secondSlide.setAttribute("x-transition:leave-start", "opacity-100 transform translate-x-0");
                        secondSlide.setAttribute("x-transition:leave-end", "opacity-0 transform -translate-x-1/2");
                    }
                }
            }))
        })
    </script>
</div>
