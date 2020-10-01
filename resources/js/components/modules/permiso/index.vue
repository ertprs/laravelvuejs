<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Permiso</h1>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <div class="container-fluid content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/rol/crear'">
              <i class="fas fa-plus-square"></i> Nuevo Permiso
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de Búsqueda</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for class="col-md-3 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input type="text" name id class="form-control" v-model="fillBusqPermiso.cNombre" @keyup.enter="getListarPermisos"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for class="col-md-3 col-form-label">Url Amigable</label>
                        <div class="col-md-9">
                          <input type="text" name id class="form-control" v-model="fillBusqPermiso.cUrl" @keyup.enter="getListarPermisos" />
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarPermisos"  v-loading.fullscreen.lock="fullscreenLoading">Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBusq">Limpiar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de Resultados</h3>
              </div>
              <div class="card-body table-responsive">
                <template v-if="listarPermisoPaginated.length">
                  <table class="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Url Amigable</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarPermisoPaginated" :key="index">
                        <td v-text="item.name"></td>
                        <td v-text="item.slug"></td>
                        <td>
                          <template v-if="item.state == 'A'">
                            <span class="badge badge-success" v-text="item.state_alias"></span> 
                          </template> 
                          <template v-else>
                             <span class="badge badge-danger" v-text="item.state_alias"></span> 
                          </template>
                        </td>
                        <td>
                        
                          <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'rol.editar', params:{id: item.id}}">
                              <i class="fas fa-pencil-alt"></i> Editar
                          </router-link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item" v-if="pageNumber > 0">
                        <a href="" class="page-link" @click.prevent="prevPage">Ant</a>
                      </li>
                      <li class="page-item" v-for="(page, index) in pagesList" :key="index" :class="[page == pageNumber ? 'active' : '' ] ">
                        <a href="" class="page-link" @click.prevent="selectPage(page)">{{page+1}}</a>
                      </li>
                      <li class="page-item" v-if="pageNumber < pageCount - 1">
                        <a href="" class="page-link" @click.prevent="nextPage">Post</a>
                      </li>
                    </ul>
                  </div>
                </template>
                <template v-else>
                  <div class="callout callout-info">
                    <h5>No se encontraron resultados...</h5>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </div>
</template>
<script>
export default {
  data(){
    return{
      fillBusqPermiso:{
        cNombre:'',
        cUrl:''
      },
      fullscreenLoading:false,
      listPermisos:[],
      pageNumber: 0,
      perPage: 5
    }
  },
  computed:{
    //Obtener el núero de página
    pageCount(){
      //20
      let a  = this.listPermisos.length,
          b = this.perPage;
          return Math.ceil(a / b);
    },
    listarPermisoPaginated(){
      let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
      return this.listPermisos.slice(inicio, fin);
    },
    pagesList(){
       let a  = this.listPermisos.length,
          b = this.perPage;
       let pageCount = Math.ceil(a / b);
       let count = 0,
       pagesArray = [];

       while (count < pageCount) {
         pagesArray.push(count);
         count++;
       }
       return pagesArray;
    }
  },
  methods:{
    limpiarCriteriosBusq(){
      this.fillBusqPermiso.cNombre='',
      this.fillBusqPermiso.cUrl=''
    },

    getListarPermisos(){
      this.fullscreenLoading = true;
      var url = '/administracion/permiso/getListarPermisos';
      axios.get(url, {
        params:{
          'cNombre': this.fillBusqPermiso.cNombre,
          'cUrl': this.fillBusqPermiso.cUrl,
         
        }
      })
      .then(response => {
        this.inicializarPaginacion()
        console.log(response.data)
        this.listPermisos = response.data
        this.fullscreenLoading = false;
      })
    },
    nextPage(){
      this.pageNumber++;
    },
    prevPage(){
      this.pageNumber--;
    },
    selectPage(page){
      this.pageNumber = page;
    },
    inicializarPaginacion(){
      this.pageNumber = 0;
    },

    
  }
};
</script>