<script>

import { Link } from '@inertiajs/inertia-vue3'
import ButtonVue from '../../Jetstream/Button.vue';
import { Inertia } from "@inertiajs/inertia";
import PaginationVue from "../Pagination.vue";
import DeleteToast from "../DeleteToast.vue";
import ToastSuccess from '../ToastSuccess.vue';



// add to component 
export default {
  components :{
    Link,
    ButtonVue,
    PaginationVue,
    DeleteToast,
    ToastSuccess
  },
  props:{
    interventions : Object,
    isConfirmDeleteModalVisible : Boolean,
    message: String, 
  },
  data() {
    return {
      isConfirmDeleteModalVisible: false,
      params: {
                search: null,
                field: null,
                direction:null,
                interventionPerPage: 5,
                
            },
            
      
    };

  },

  methods:{
    destroy(id) {
        Inertia.delete(route('interventions.destroy', id));
    },
    showConfirmDeleteModal(record) {
      this.isConfirmDeleteModalVisible = record.id;

    },
    closeConfirmDeleteModal() {
      this.isConfirmDeleteModalVisible = false;
    },
    closeToastSuccess() {
      this.$page.props.flash.success = null;
    },
    sort(field){
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' :'asc';
        },
    dropFilter(){
             this.dropfilter = !this.dropfilter;
        },
  },

  watch: {
    params: {
            handler(){
                return this.$inertia.get( this.route('interventions.index') , this.params , {replace: true, preserveState: true}  );
                    
            },
            deep: true,
  },
}
}

</script>
<template>
  <Transition>
      <ToastSuccess
          v-if="$page.props.flash.success"
          class="absolute bottom-0 right-0"
          :message="$page.props.flash.success"
          @close="closeToastSuccess">
      </ToastSuccess>
  </Transition>
  <div class="flex flex-col">
      <div class="inline-flex my-8 justify-end items-center">
        
      <div class="mr-auto text-gray-800 text-2xl font-semibold">Interventions</div>
      <Link :href="route('interventions.create')">
      <button
        type="button"
        data-mdb-ripple="true"
        data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 float-right bg-indigo-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      >Ajouter Intervention</button>
      </Link>
    </div>

    <div class=" mb-4 max-w-xs">
          <input type="search" 
                    v-model="params.search"
                    aria-label="Search" 
                    placeholder="Search..." 
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
        
        </div>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">         
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-500 text-white	">
              <tr>
                
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider" >
                  <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('titre')">Titre
                        <svg v-if="params.field === 'titre' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>
 
                        <svg v-if="params.field === 'titre' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                  </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Site</th>

                <th scope="col" class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                  <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('status')">Status
                        <svg v-if="params.field === 'status' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>
 
                        <svg v-if="params.field === 'status' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                        </svg>
                        </span>
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium  uppercase tracking-wider">Actions</th>
                
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
             
              <tr v-for="intervention in interventions.data" :key="intervention.id">
                <td class="px-6 py-4 whitespace-nowrap bg-gray">
                  <div class="flex items-center">
                    
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{ intervention.titre }}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ intervention.type }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ intervention.site.nom }}</div>
                </td>
                <td v-if="intervention.status === 'Planifiée'" class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800"> Planifiée </span>
                </td>
                <td v-if="intervention.status === 'Effectuée'" class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Effectuée </span>
                </td>
                <td v-if="intervention.status === 'Annulée'" class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-600"> Annulée </span>
                </td>
                <td class="px-6 whitespace-nowrap py-7 ml-4 flex flex-row items-center justify-center">
                  
                  
                  <Link :href="route('interventions.show',intervention.id)" class="flex-shrink-0 rounded-full hover:bg-blue-100 text-blue-700 cursor-pointer mr-4"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg></Link>
                  <Link :href="route('interventions.edit',intervention.id)" class="flex-shrink-0 rounded-full hover:bg-orange-100 text-orange-500 cursor-pointer mr-4"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3" id="IconChangeColor"><path d="M12 20h9" id="mainIconPathAttribute" fill="#ffffff" stroke="fillCurrent"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" id="mainIconPathAttribute" fill="#ffffff" stroke="#ff9500"></path></svg></Link>

                          <button
                          @click="showConfirmDeleteModal(intervention)"
                          class="rounded-full hover:bg-red-100 cursor-pointer"
                          type="button">
                            <svg style="color: #DC2626" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="#DC2626"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="#DC2626"></path> </svg>
                          </button>
                          <div class="flex align-items justify-center">
                          <DeleteToast
                            v-show="isConfirmDeleteModalVisible == intervention.id"
                            modalHeadline="Supprimer intervention"
                            deleteMessage="Etes-vous sûr?"
                            @deleteRecordEvent="destroy(intervention.id)"
                            @close="closeConfirmDeleteModal"
                            >
                          </DeleteToast>
                          </div>
                 
                </td>
              </tr>
            </tbody>
          </table>
          <div class="inline-grid grid-cols-3 snap-center ">
          <PaginationVue class="m-4" :links="interventions.links" />
          <select class="m-4 h-10" name="interventionPerPage" id="interventionPerPage" v-model="params.interventionPerPage" aria-label="interventionPerPage"   placeholder="interventionPerPage" > 
                        <option disabled value="interventionPerPage">Intervention par page</option>
        
                        <option value="5"> 5 par page</option>
                        <option value="10" >10 par page </option>
                        <option value="20">20 par page  </option>
                        <option value="30">30 par page  </option>
                        <option value="50">50 par page  </option>
                        <option value="100">100 par page  </option>
                                
          </select> 
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>


