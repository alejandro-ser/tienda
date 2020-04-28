const confirmarEliminar = new Vue({
    el: '#confirmarEliminar',
    data: {
        url_a_eliminar: ''
    },
    methods: {
        deseasEliminar(id) {
            this.url_a_eliminar = document.getElementById('urlBase').innerHTML+'/'+id;
            $('#mdalEliminar').modal('show');
        }
    },
});