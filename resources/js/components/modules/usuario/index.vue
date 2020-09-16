<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuario</h1>
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
            <router-link class="btn btn-info btn-sm" :to="'/usuario/crear'">
              <i class="fas fa-plus-square"></i> Nuevo usuario
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
                          <input type="text" name id class="form-control" v-model="fillBusqUsuario.cNombre" @keyup.enter="getListarUsuario"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for class="col-md-3 col-form-label">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" name id class="form-control" v-model="fillBusqUsuario.cUsuario" @keyup.enter="getListarUsuario" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for class="col-md-3 col-form-label">Correo electronico</label>
                        <div class="col-md-9">
                          <input type="email" name id class="form-control" v-model="fillBusqUsuario.cCorreo" @keyup.enter="getListarUsuario"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for class="col-md-3 col-form-label">Estado</label>
                        <div class="col-md-9">
                          <el-select v-model="fillBusqUsuario.cEstado" placeholder="Selecciona un estado" clearable>
                            <el-option
                              v-for="item in listEstado"
                              :key="item.value"
                              :label="item.label"
                              :value="item.value">
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarUsuario"  v-loading.fullscreen.lock="fullscreenLoading">Buscar</button>
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
                <template v-if="listarUsuariosPaginated.length">
                  <table class="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Fotografia</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarUsuariosPaginated" :key="index">
                        <td>
                          <li class="user-block">
                            <img src="/img/avatar.png" :alt="item.username" class="profile-avatar-img img-fluid img-circle">
                          </li>

                        </td>
                        <td v-text="item.fullname"></td>
                        <td v-text="item.email"></td>
                        <td v-text="item.username"></td>
                        <td>
                          <template v-if="item.state == 'A'">
                            <span class="badge badge-success" v-text="item.state_alias"></span> 
                          </template> 
                          <template v-else>
                             <span class="badge badge-danger" v-text="item.state_alias"></span> 
                          </template>
                        </td>
                        <td>
                          <router-link class="btn btn-primary btn-sm" :to="'/'">
                            <i class="fas fa-folder"></i> Ver
                          </router-link>
                          <router-link class="btn btn-primary btn-sm" :to="'/'">
                            <i class="fas fa-pencil-alt"></i> Editar
                          </router-link>
                          <router-link class="btn btn-success btn-sm" :to="'/'">
                            <i class="fas fa-key"></i> Permisos
                          </router-link>
                          <router-link class="btn btn-danger btn-sm" :to="'/'">
                            <i class="fas fa-trash"></i> Desactivar
                          </router-link>
                          <router-link class="btn btn-success btn-sm" :to="'/'">
                             <i class="fas fa-check"></i> Activar
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
      fillBusqUsuario:{
        cNombre:'',
        cUsuario:'',
        cCorreo:'',
        cEstado:''
      },
      fullscreenLoading:false,
      listUsuario:[],
      listEstado:[
        {value:'A', label:'Activo'},
        {value:'I', label:'Inactivo'}
      ],
  pageNumber: 0,
  perPage:5
    }
  },
  computed:{
    //Obtener el núero de página
    pageCount(){
      //20
      let a  = this.listUsuario.length,
          b = this.perPage;
          return Math.ceil(a / b);
    },
    listarUsuariosPaginated(){
      let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
      return this.listUsuario.slice(inicio, fin);
    },
    pagesList(){
       let a  = this.listUsuario.length,
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
      this.fillBusqUsuario.cNombre='',
      this.fillBusqUsuario.cUsuario='',
      this.fillBusqUsuario.cCorreo='',
      this.fillBusqUsuario.cEstado=''

    },
    limpiarBandejaUsuarios(){
      this.listUsuario=[]
    },
    getListarUsuario(){
      this.fullscreenLoading = true;
      var url = '/administracion/usuario/getListarUsuarios';
      axios.get(url, {
        params:{
          'cNombre': this.fillBusqUsuario.cNombre,
          'cUsuario': this.fillBusqUsuario.cUsuario,
          'cCorreo': this.fillBusqUsuario.cCorreo,
          'cEstado': this.fillBusqUsuario.cEstado
        }
      })
      .then(response => {
        this.inicializarPaginacion()
        console.log(response.data)
        this.listUsuario = response.data
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
    }
  }
};
</script>