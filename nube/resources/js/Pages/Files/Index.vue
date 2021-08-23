<template>
    <app-layout title="Dashboard">
      <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
  </template>
    <div class="max-w-6xl mx-auto py-12 sm:px-6 lg:px-12">
    <div class="flex flex-col">
    <div class="shadow bg-white md:rounded-md p-4">
         <div class="flex flex-wrap items-center justify-between mb-4">
          <div class="flex-grow md:mr-3 mt-4 md:mt-0 order-3 w-full md:w-auto md:order-1">
           <input type="search" placeholder="Busca una carpeta o archivo" class="w-full pl-3 h-12 border-2 rounded-lg">
         </div>
        <div class="order-2">
          <div>
                     <button type="submit" class="bg-blue-500 text-white px-6 h-10 rounded-lg mr-2 font-bold">subir</button>
            </div>
          </div>
        </div>

       <div class="border-2 border-gray-200 rounded-lg">
         <div class="py-2 px-3">
            <div class="flex items-center">
               <div class="font-bold text-gray-400">
                  Leo
                 <button class="text-blue-500 text-sm ml-6"> Limpiar Busquedad </button>
               </div>
                 <a class="font-bold text-gray-400">

                 </a>
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-gray-300 w-5 h-5 mx-1">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                 </svg>
            </div>
       </div>

    <div class="overflow-auto">
       <table class="w-full">
         <thead class="bg-gray-100">
           <tr>
               <th class="text-left py-2 px-3">Nombre</th>
                <th class="text-left py-2 px-3 w-2/12">Creacion</th>
                <th class="text-left py-2 px-3 w-2/12">Borrar</th>
            </tr>
         </thead>

         <tbody>
            <tr class="border-gray-100 border-b-2 hover:bg-gray-100">
              <td class="p-2">
                <form @submit.prevent="submit" class="flex items-center">
                   <input type="text" class="w-45 px-3 h-10 border-2 border-gray-200 rounded-lg mr-2" placeholder="New Folder" id="name" v-model="form.name" for="name">
                     <button type="submit" class="bg-blue-500 text-white px-6 h-10 rounded-lg mr-2 font-bold">Crear</button>
                </form>
              </td>
              <td></td>
              <td></td>

            </tr>
            <tr class="border-gray-100 border-b-2 hover:bg-gray-100" v-for="parent in objetos">
               <td class="py-2 px-3 flex items-center">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                  <Link :href="route('files.child', parent.objeto.id)" class="p-2 font-bold text-blue-600 flex-grow">
                        {{ parent.objeto.name }}
                  </Link>
                  <a class="p-2 font-bold text-blue-600 flex-grow">
                       <button class="text-gray-400 font-bold"> Renombrar </button>
                  </a>
               </td>
               <td class="py-2 px-3">
                 {{ moment(parent.objeto.created_at).format('L') }}
               </td>
               <td class="py-2 px-3">
               <div class="w-4 mr-2 transform text-yellow-400 hover:text-indigo-500 hover:scale-110">
                <Link method="delete">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </Link>
                  </div>
               </td>
             </tr>
            </tbody>
          </table>
        </div>
        <div class="p-3 text-gray-700">
          Esta carpeta esta vacia
        </div>
     </div>
   </div>
  </div>
 </div>
 </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import Welcome from '@/Jetstream/Welcome.vue'
    import { Inertia } from '@inertiajs/inertia'
    import { reactive } from 'vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import  moment  from 'moment'

    export default {
        components: {
            AppLayout,
            Welcome,
            Link
        },
         methods: {
            moment
        },
        props: {
            childrens: Array,
            objetos: Array,
            ancestors: Array
        },
        setup() {
            const form = reactive({
                name:null,
            })
            function submit() {
                Inertia.post('/Files/Index', form),
                {
                    preserveState: true
                },
                {
                     resetOnSuccess: false
                }
            }
              return { form, submit}
        },
    }
</script>
