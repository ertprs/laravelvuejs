import Vue from "vue";
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes:[
        {path:'/', component: require('./components/modules/dashboard/index').default},
        {path:'/pedido', component: require('./components/modules/pedido/index').default},
        {path:'/categoria', component: require('./components/modules/categoria/index').default},
        {path:'/cliente', component: require('./components/modules/cliente/index').default},
        {path:'/producto', component: require('./components/modules/producto/index').default},
        {path:'/reporte', component: require('./components/modules/reporte/index').default},
        {path:'/rol', component: require('./components/modules/rol/index').default},
        {path:'/usuario', component: require('./components/modules/usuario/index').default},
        {path:'/permiso', component: require('./components/modules/permiso/index').default},
    ],
    mode:'history'
})