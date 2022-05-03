<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>

<body class="bg-pink-200">
    <div>
        @include('/header')

        {{-- carre produit --}}
        <div class="flex justify-between mt-5">
            <div class="bg-white max-w-sm rounded overflow-hidden shadow-lg ml-auto mr-auto">
                <div class="px-6 py-4">
                    <div class="font-bold text-5xl mb-2 text-center">Profil</div>
                    <div class="flex">
                        <input
                            class="shadow appearance-none border mt-5 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Nom"><button
                            class="border mt-5 py-2 px-3 focus:shadow-outline shadow">Modifier</button>
                    </div>
                    <div class="flex">
                        <input
                            class="shadow appearance-none border mt-8 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Prenom"><button
                            class="border mt-8 py-2 px-3 focus:shadow-outline shadow">Modifier</button>
                    </div>
                    <div class="flex">
                        <input
                            class="shadow appearance-none border mt-8 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Email"><button
                            class="border mt-8 py-2 px-3 focus:shadow-outline shadow">Modifier</button>
                    </div>
                    <div class="flex">
                        <input
                            class="shadow appearance-none border mt-8 mb-5 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Adresse"><button
                            class="border mt-8 mb-5 py-2 px-3 focus:shadow-outline shadow">Modifier</button>
                    </div>
                    <div class="flex flex-col align-right">
                        <button class="border py-2 px-3 focus:shadow-outline shadow" id="menu-btn2">Ajouter une
                            adresse</button>
                        <div class="hidden flex-col-reverse " id="dropdown2">
                            <input
                                class="shadow appearance-none border mt-8 mb-5 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Adresse">
                        </div>
                    </div>
                    </>
                </div>
            </div>

        </div>
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const menuBtn = document.querySelector('#menu-btn2')
                const dropdown = document.querySelector('#dropdown2')

                menuBtn.addEventListener('click', () => {
                    /* if(dropdown.classList.contains('hidden')){
                        dropdown.classList.remove('hidden');
                        dropdown.classList.add('flex');
                    }else{
                        dropdown.classList.remove('flex')
                        dropdown.classList.add('hidden')
                    } */

                    dropdown.classList.toggle('hidden')
                    dropdown.classList.toggle('flex')
                })
            })
        </script>
</body>

</html>
