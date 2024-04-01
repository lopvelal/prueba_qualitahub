
export default {
    component: () => import('../Views/Layout.vue'),
    children: [
        {
            path: '',
            name: 'Alumnos',
            component: () => import('../components/Listado.vue')
        },
        {
            path: '/alumno/crear',
            name: 'Alumno.crear',
            component: () => import('../components/Crear.vue')
        },
        {
            path: '/alumno/editar/:id',
            name: 'Alumno.editar',
            component: () => import('../components/Editar.vue')
        }
    ]
}
