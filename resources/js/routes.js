import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: "/login",
            name: "login",
            component: require("./components/modules/authenticate/login").default
        },
        {
            path: "/",
            name: "dashboard.index",
            component: require("./components/modules/dashboard/index").default
        },
        {
            path: "/pedido",
            name: "pedido.index",
            component: require("./components/modules/pedido/index").default
        },
        {
            path: "/categoria",
            name: "categoria.index",
            component: require("./components/modules/categoria/index").default
        },
        {
            path: "/cliente",
            name: "cliente.index",
            component: require("./components/modules/cliente/index").default
        },
        {
            path: "/producto",
            name: "producto.index",
            component: require("./components/modules/producto/index").default
        },
        {
            path: "/reporte",
            name: "reporte.index",
            component: require("./components/modules/reporte/index").default
        },
        {
            path: "/rol",
            name: "rol.index",
            component: require("./components/modules/rol/index").default
        },
        {
            path: "/rol/crear",
            name: "cliente.index",
            component: require("./components/modules/rol/create").default
        },
        {
            path: "/rol/editar/:id",
            name: "rol.editar",
            props: true,
            component: require("./components/modules/rol/edit").default
        },
        {
            path: "/usuario",
            name: "usuario.index",
            component: require("./components/modules/usuario/index").default
        },
        {
            path: "/usuario/crear",
            name: "usuario.crear",
            component: require("./components/modules/usuario/create").default
        },
        {
            path: "/usuario/editar/:id",
            name: "usuario.editar",
            props: true,
            component: require("./components/modules/usuario/edit").default
        },
        {
            path: "/usuario/ver:id",
            name: "usuario.ver",
            props: true,
            component: require("./components/modules/usuario/view").default
        },
        {
            path: "/usuario/permiso/:id",
            name: "usuario.permiso",
            props: true,
            component: require("./components/modules/usuario/permission").default
        },
        {
            path: "/permiso",
            name: "permiso.index",
            component: require("./components/modules/permiso/index").default
        },
        {
            path: "/permiso/crear",
            name: "permiso.crear",
            component: require("./components/modules/permiso/create").default
        },
        {
            path: "/permiso/editar/:id",
            name: "permiso.editar",
            props: true,
            component: require("./components/modules/permiso/edit").default
        },
    ],
    mode: "history",
    linkActiveClass: "active"
});
