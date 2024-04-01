
export default {
    component: () => import('../Views/Layout.vue'),
    children: [
        {
            path: '',
            name: 'Escuelas',
            component: () => import('../components/Listado.vue')
        },
        {
            path: '/escuela/crear',
            name: 'Escuela.crear',
            component: () => import('../components/Crear.vue')
        },
        {
            path: '/escuela/editar/:id',
            name: 'Escuela.editar',
            component: () => import('../components/Editar.vue')
        }
    ]
}
