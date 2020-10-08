import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: "/",
            component: require("./components/modules/dashboard/index").default
        },
        {
            path: "/pedido",
            component: require("./components/modules/pedido/index").default
        },
        {
            path: "/categoria",
            component: require("./components/modules/categoria/index").default
        },
        {
            path: "/cliente",
            component: require("./components/modules/cliente/index").default
        },
        {
            path: "/producto",
            component: require("./components/modules/producto/index").default
        },
        {
            path: "/reporte",
            component: require("./components/modules/reporte/index").default
        },
        {
            path: "/rol",
            component: require("./components/modules/rol/index").default
        },
        {
            path: "/rol/crear",
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
            component: require("./components/modules/usuario/index").default
        },
        {
            path: "/usuario/crear",
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
            component: require("./components/modules/permiso/index").default
        },
        {
            path: "/permiso/crear",
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
