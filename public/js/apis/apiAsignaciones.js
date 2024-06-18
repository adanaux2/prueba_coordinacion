var ruta = document.querySelector("[name=route]").value;

var apiProfe = "/apiProfe";
// Crear una instancia de Vue
var Lisc = ruta + "/apiLisc";


const app = Vue.createApp({
    data() {
        return {
            mensaje: "apiMaterias desde vue 3",
            principal: 0,
            ProfesObtenidos: [],
            usuarioSeleccionado: {},
            lisc: [],
            licenciaturaSelected:'',
            licRvoe:[],
            year:'',

        };
    },
    created() {
        this.obtenerProfe();
        this.obtenerLisc();
    },
    watch: {
        licenciaturaSelected(newValue, licenciaturaSelecte) {
        //   console.log(`El mensaje ha cambiado de '${licenciaturaSelecte}' a '${newValue}'`);
        window.axios
                .get(Lisc + '/' + newValue)
                .then((response) => {
                    // console.log(response.data);
                    this.licRvoe= response.data.rvoe;
                    // console.log(this.licRvoe);
                    this.updateYear();
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        }
    },

    methods: {
        updateYear() {
            this.year = new Date().getFullYear();
        },
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
        },
        agregarGrupo:function(){
            $("#modalNG").modal("show");
        },
        obtenerLisc: function () {
            window.axios
                .get(Lisc)
                .then((response) => {
                    // console.log(response.data);
                    this.lisc = response.data;
                    console.log(this.lisc);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiAsignacion");
