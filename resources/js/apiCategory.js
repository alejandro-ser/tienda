const apiCategory = new Vue({
    el: '#apiCategory',
    data: {
        nombre: '',
        slug: '',
        div_mensajeslug: '',
        div_mensaje_category: '',
        div_clase_slug: 'badge badge-danger',
        div_aparecer: false,
        deshabilitar_boton: 1
    },
    computed: {
        generarSlug : function(){
            var char = {
                "á":"a","é":"e","í":"i","ó":"o","ú":"u",
                "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
                "ñ":"n","Ñ":"N"," ":"-","_":"-"
            }
            var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;

            this.slug = this.nombre.trim().replace(expr, function(e){
                return char[e]
            }).toLowerCase()

            return this.slug;
        }
    },
    methods: {
        getCategory() {
            if(this.slug){
                let url  = '/api/category/' + this.slug;
                axios.get(url).then(response => {
                    this.div_mensajeslug = 'Slug '+response.data;
                    this.div_mensaje_category = 'Categoría '+response.data;
                    if(this.div_mensajeslug === "Slug disponible") {
                        this.div_clase_slug = 'badge badge-success';
                        this.deshabilitar_boton = 0;
                    } else {
                        this.div_clase_slug = 'badge badge-danger';
                        this.deshabilitar_boton = 1;
                    }
                    this.div_aparecer = true;
                })
            } else {
                this.div_mensajeslug = 'Escribe una categoría';
                this.div_mensaje_category = 'Escribe una categoría';
                this.div_clase_slug = 'badge badge-danger';
                this.deshabilitar_boton = 1;
                this.div_aparecer = true;
            }
        }
    },
    mounted(){
        if(document.getElementById('nombre').dataset.value) {
            this.nombre = document.getElementById('nombre').dataset.value;
            this.deshabilitar_boton = 0;
        }
    }
});