<x-user.app-layout>


    <x-section-content>
        <!-- This is an example component -->
        <div class="container mx-auto shadow-lg rounded-lg">
            <!-- headaer -->
            {{-- <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
        <div class="font-semibold text-2xl">GoingChat</div>
        <div class="w-1/2">
            <input type="text" name="" id="" placeholder="search IRL"
                class="rounded-2xl bg-gray-100 py-3 px-5 w-full shadow-md" />
        </div>
        <div class="h-12 w-12 p-2 bg-yellow-500 rounded-full shadow-md text-white font-semibold flex items-center justify-center">
            RA
        </div>
    </div> --}}
            <!-- end header -->
            <!-- Chatting -->
            <div class="flex flex-row justify-between bg-white">
                <!-- chat list -->
                <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                    <!-- search compt -->
                    <div class="border-b-2 py-4 px-2">
                        <input type="text" placeholder="Buscar contacto"
                            class="py-2 px-2 border-2 border-gray-300 rounded-2xl w-full shadow-md" />
                    </div>
                    <!-- end search compt -->
                    <!-- user list -->


                    {{-- * LISTA DE CONTACTOS --}}


                    {{-- <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2">
                        <div class="w-1/4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-12 w-12 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">Luis1994</div>
                            <span class="text-gray-500">Pick me at 9:00 Am</span>
                        </div>
                    </div>
                    <div class="flex flex-row py-4 px-2 items-center border-b-2">
                        <div class="w-1/4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-12 w-12 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">Everest Trip 2021</div>
                            <span class="text-gray-500">Hi Sam, Welcome</span>
                        </div>
                    </div>
                    <div class="flex flex-row py-4 px-2 items-center border-b-2 border-l-4 border-teal-400">
                        <div class="w-1/4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-12 w-12 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">MERN Stack</div>
                            <span class="text-gray-500">Lusi : Thanks Everyone</span>
                        </div>
                    </div>
                    <div class="flex flex-row py-4 px-2 items-center border-b-2">
                        <div class="w-1/4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-12 w-12 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">Javascript Indonesia</div>
                            <span class="text-gray-500">Evan : some one can fix this</span>
                        </div>
                    </div>
                    <div class="flex flex-row py-4 px-2 items-center border-b-2">
                        <div class="w-1/4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-12 w-12 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">Javascript Indonesia</div>
                            <span class="text-gray-500">Evan : some one can fix this</span>
                        </div>
                    </div>
                    <div class="flex flex-row py-4 px-2 items-center border-b-2">
                        <div class="w-1/4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-12 w-12 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">Javascript Indonesia</div>
                            <span class="text-gray-500">Evan : some one can fix this</span>
                        </div>
                    </div> --}}


                    @foreach ($patients as $patient)
                        <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2">
                            <div class="w-1/4">
                                <img src="{{ verifyMultipleAvatar($patient->file, $patient->names) }}"
                                    class="object-cover h-12 w-12 rounded-full" alt="{{ $patient->full_name }}" />
                            </div>
                            <div class="w-full">
                                <div class="text-sm font-semibold"> {{ $patient->full_name }} </div>
                                {{-- <span class="text-xs text-gray-500">Pick me at 9:00 Am</span> --}}
                                <span class="text-xs text-gray-500">{{ $patient->email }}</span>
                            </div>
                        </div>
                    @endforeach




                    <!-- end user list -->
                </div>
                <!-- end chat list -->
                <!-- message -->
                <div class="w-full shadow-md px-5 flex flex-col justify-between">
                    <div class="flex flex-col mt-5">
                        <div class="flex justify-end mb-4">
                            <div
                                class="mr-2 py-3 px-4 bg-teal-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                Welcome!
                            </div>
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-8 w-8 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="flex justify-start mb-4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-8 w-8 rounded-full shadow-md" alt="" />
                            <div
                                class="ml-2 py-3 px-4 bg-gray-300 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat
                                at praesentium, aut ullam delectus odio error sit rem. Architecto
                                nulla doloribus laborum illo rem enim dolor odio saepe,
                                consequatur quas?
                            </div>
                        </div>
                        <div class="flex justify-end mb-4">
                            <div>
                                <div
                                    class="mr-2 py-3 px-4 bg-teal-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Magnam, repudiandae.
                                </div>

                                <div
                                    class="mt-4 mr-2 py-3 px-4 bg-teal-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Debitis, reiciendis!
                                </div>
                            </div>
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-8 w-8 rounded-full shadow-md" alt="" />
                        </div>
                        <div class="flex justify-start mb-4">
                            <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                                class="object-cover h-8 w-8 rounded-full shadow-md" alt="" />
                            <div
                                class="ml-2 py-3 px-4 bg-gray-300 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                bye!
                            </div>
                        </div>
                    </div>
                    <div class="py-5">
                        <input class="w-full shadow-md bg-slate-100 py-5 px-3 rounded-xl" type="text"
                            placeholder="Escribe tu mensaje aqui..." />
                    </div>
                </div>
                <!-- end message -->
                <div class="w-2/5 border-l-2 px-5">
                    <div class="flex flex-col">
                        <div class="font-semibold text-xl py-4">Mern Stack Group</div>
                        <img src="https://ui-avatars.com/api/?name=Odessa+Peck&color=0284c7&background=ffffff"
                            class="object-cover rounded-xl h-64" alt="" />
                        <div class="font-semibold py-4">Created 22 Sep 2021</div>
                        <div class="font-light">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt,
                            perspiciatis!
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-section-content>



</x-user.app-layout>
