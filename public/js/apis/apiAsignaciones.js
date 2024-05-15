var apiProfe = "http://localhost/prueba_coordinacion/public/apiProfe";
// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: "apiMaterias desde vue 3",
            principal: 0,
            ProfesObtenidos: [],
            usuarioSeleccionado: {},
        };
    },
    created() {
        this.obtenerProfe();
    },

    methods: {
        vista1: function () {
            this.principal = 1;
        },
        obtenerProfe: function () {
            window.axios
                .get(apiProfe)
                .then((response) => {
                    // console.log(response.data);
                    this.ProfesObtenidos = response.data;
                    console.log(this.ProfesObtenidos);

                    $(document).ready(function () {
                        $("#dataTable").DataTable({
                            language: {
                                lengthMenu:
                                    "Mostrando _MENU_ elementos en esta pagina",
                                zeroRecords: "Sin coincidencias",
                                info: "Página _PAGE_ de _PAGES_",
                                infoEmpty: "Sin datos disponibles",
                                infoFiltered:
                                    "(Filtrado de  _MAX_ datos en total)",
                                search: "Buscar:",
                            },
                        });
                    });
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        verModal: function () {
            $("#modalP").modal("show");
        },
        agregarUsuario: function (usuario) {
            this.usuarioSeleccionado = { ...usuario };
            console.log(this.usuarioSeleccionado);
            this.cerrarModal();
        },
        cerrarModal:function(){
            $("#modalP").modal("hide");
        }
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiAsignacion");
