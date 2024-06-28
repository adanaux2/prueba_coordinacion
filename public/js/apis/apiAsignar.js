var ruta = document.querySelector("[name=route]").value;

var apiMaterias = ruta + "/apiMaterias";
var apiGrupos = ruta + "/apiGrupo";
var getMate = ruta + "/getMate/";
var apiProfe = ruta + "/apiProfe";
var getConsulta = ruta + "/getConsultaProfe/";

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: "Asignar profesores final",
            grupos: [],
            unGrupo: [],
            materias: [],
            id: "",
            principal: 0,
            ProfesObtenidos: [],
            buscarCoincidencias: "",
        };
    },
    created() {
        // this.obtenerMaterias();
        // this.obtenerLicenciaturas();
        this.obtenerGrupos();
    },

    methods: {
        openModal: function () {
            $(exampleModal).modal("show"); // Usa jQuery para mostrar la ventana modal
        },
        obtenerMaterias: function () {
            window.axios
                .get(apiMaterias)
                .then((response) => {
                    // console.log(response.data);
                    this.materias = response.data;
                    console.log(this.materias);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        obtenerLicenciaturas: function () {
            window.axios.get(apiR).then((response) => {
                // console.log(response.data);
                this.rObtenidas = response.data;
                // console.log(this.licenciaturasObtenidas);
            });
            // .catch((error) => {
            //     console.error("Hubo un error al obtener los datos:", error);
            // });
        },
        obtenerGrupos: function () {
            window.axios
                .get(apiGrupos)
                .then((response) => {
                    // console.log(response.data);
                    this.grupos = response.data;
                    // console.log(this.grupos);
                    $(document).ready(function () {
                        $("#dataTableGrupos").DataTable({
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
        editarGrupo: function (id) {
            // alert(id);
            this.id = id;
            window.axios
                .get(apiGrupos + "/" + id)
                .then((response) => {
                    // console.log(response.data);

                    this.unGrupo = response.data;
                    console.log(this.unGrupo);
                    this.getMate();
                    this.principal = 1;
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        getMate: function () {
            // alert(id);
            window.axios
                .get(getMate + this.id)
                .then((response) => {
                    // console.log(response.data);
                    this.materias = response.data;
                    // Si unGrupo no tiene un array materias, inicialízalo
                    if (!this.unGrupo.materias) {
                        this.unGrupo.materias = [];
                    }
                    this.unGrupo.materias.push(...this.materias);
                    // console.log(this.materias);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        obtenerProfe: function () {
            alert("buscando");
            window.axios
                .get(getConsulta + this.buscarCoincidencias)
                .then((response) => {
                    // console.log(response.data);
                    this.ProfesObtenidos = [];
                    this.ProfesObtenidos = response.data[0].profesor;
                    // console.log(this.ProfesObtenidos);

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
        verModal: function (id) {
            this.buscarCoincidencias = id;
            $("#modalP").modal("show");
            $("#dataTable").DataTable().destroy();
            this.obtenerProfe();
        },
        agregarProfe: function(id){
            alert(id);
        }
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiAsignar");
