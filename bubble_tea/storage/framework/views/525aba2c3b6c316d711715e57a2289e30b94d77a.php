<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>

<body class="bg-pink-200">
    <?php echo $__env->make('/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="bg-white shadow-lg overflow-hidden flex p-1 ml-56 mr-56 mt-8 rounded">
        <img class="w-24 h-24 border border-red-400 rounded-full"
            src="https://assets.afcdn.com/recipe/20200605/111747_w1024h1024c1cx2808cy1872.webp" alt="">
        <div class="flex flex-col justify-center flex-1">
            <h3 class="text-xl font-bold ml-4">BubbleTea Fraise</h3>
            <button
                class="border ml-10 mt-8 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center"
                id="menu-btn2">Supplément <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <div class="hidden flex-col rounded ml-10 p-2 text-sm w-32" id="dropdown2">
                <select class="w-full mt-1 form-multiselect" multiple="">
                    <option>Supplément 1</option>
                    <option>Supplément 2</option>
                    <option>Supplément 3</option>
                    <option>Supplément 4</option>
                    <option>Supplément 5</option>
                </select>
            </div>
            <div class="flex">

                <section id="quantité" class="block mt-8 "></section>
                <button onclick="addCqt(1)"
                    class="border ml-10 mt-8 py-2 px-3 focus:shadow-outline shadow">Ajouter</button>
                <button onclick="enleQtt(1)" class="border mt-8 py-2 px-3 focus:shadow-outline shadow">Retirer</button>
            </div>
            <section id="prix_tt" class="block mt-8 "></section>
            <button class="border mt-8 py-2 px-3 focus:shadow-outline shadow rounded-lg">Ajouter au panier</button>
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
            qtt = 0;
            prix = 0

            function displayqtt() {
                document.getElementById("quantité").innerHTML = qtt;
            }

            function displayprix() {
                document.getElementById("prix_tt").innerHTML = prix;
            }

            function addCqt(x) {
                qtt = qtt + x;
                displayqtt();
                prix = prix + 32;
                displayprix();
            }

            function enleQtt(x) {
                qtt = qtt - x;
                displayQtt();
                prix = prix - 32;
                displayprix();
                if (qtt < 0) {
                    qtt = 0
                    prix = 0
                }
            }
        </script>
</body>

</html>
<?php /**PATH C:\Users\koboy\Bubble_Tea\bubble_tea\resources\views/add.blade.php ENDPATH**/ ?>