var ruta = document.querySelector("[name=route]").value;

var apiProfe = ruta + "/apiProfe";
// Crear una instancia de Vue
var Lisc = ruta + "/apiLisc";
var materias = ruta + "/getMaterias/";
var apiGrupo = ruta + "/apiGrupo";
var apimatG = ruta + "/apimatG";

const app = Vue.createApp({
    data() {
        return {
            mensaje: "apiMaterias desde vue 3",
            principal: 0,
            ProfesObtenidos: [],
            usuarioSeleccionado: {},
            lisc: [],
            licenciaturaSelected: "",
            licRvoe: [],
            year: "",
            cuatriSelected: 0,
            materias: [],
            rvoeSelected: "",
            periodoSelected: "",
            id: "",
        };
    },
    created() {
        // this.obtenerProfe();
        this.obtenerLisc();
        this.generateUniqueId();
    },
    watch: {
        licenciaturaSelected(newValue) {
            window.axios
                .get(Lisc + "/" + newValue)
                .then((response) => {
                    // console.log(response.data);
                    this.licRvoe = response.data.rvoe;
                    // console.log(this.licRvoe);
                    this.updateYear();
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        cuatriSelected(newValue2) {
            window.axios
                .get(materias + newValue2 + "/" + this.rvoeSelected)
                .then((response) => {
                    this.materias = response.data;
                    console.log(this.materias);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
    },

    methods: {
        updateYear() {
            this.year = new Date().getFullYear();
        },
        vista1: function () {
            this.principal = 1;
        },
        obtenerProfe: function () {
            alert('buscando');
            window.axios
                .get(apiProfe)
                .then((response) => {
                    // console.log(response.data);
                    this.ProfesObtenidos = response.data;
                    console.log(this.ProfesObtenidos);

                    // $(document).ready(function () {
                    //     $("#dataTable").DataTable({
                    //         language: {
                    //             lengthMenu:
                    //                 "Mostrando _MENU_ elementos en esta pagina",
                    //             zeroRecords: "Sin coincidencias",
                    //             info: "Página _PAGE_ de _PAGES_",
                    //             infoEmpty: "Sin datos disponibles",
                    //             infoFiltered:
                    //                 "(Filtrado de  _MAX_ datos en total)",
                    //             search: "Buscar:",
                    //         },
                    //     });
                    // });
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        verModal: function () {
            $("#modalP").modal("show");
            this.obtenerProfe();
        },
        agregarUsuario: function (usuario) {
            this.usuarioSeleccionado = { ...usuario };
            console.log(this.usuarioSeleccionado);
            this.cerrarModal();
        },
        cerrarModal: function () {
            $("#modalP").modal("hide");
        },
        agregarGrupo: function () {
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
        generateUniqueId() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, "0"); // Los meses empiezan desde 0
            const day = String(now.getDate()).padStart(2, "0");
            const hours = String(now.getHours()).padStart(2, "0");
            const minutes = String(now.getMinutes()).padStart(2, "0");
            const seconds = String(now.getSeconds()).padStart(2, "0");
            // const milliseconds = String(now.getMilliseconds()).padStart(3, '0');

            // Concatenar todos los valores en una sola cadena
            // this.id = `${year}${month}${day}${hours}${minutes}${seconds}${milliseconds}`;
            this.id = `${year}${month}${day}${hours}${minutes}${seconds}`;
            // this.id = uuid.v4();
            // console.log('ID generado:', this.id);
        },
        guardarGrupo: function () {
            const grupo = {
                id_grupo: this.id,
                id_licenciatura: this.licenciaturaSelected,
                id_rvoe: this.rvoeSelected,
                periodo: this.periodoSelected,
                anio: this.year,
                cuatrimestre: this.cuatriSelected,
            };
            console.log(grupo);

            axios
                .post(apiGrupo, grupo)
                .then((response) => {
                    // console.log("exito");
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Grupo registrado",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.guardarMateriasGrupos();
                })
                .catch((error) => {
                    console.error("Error submitting form:", error);
                });
            $("#modalNG").modal("hide");
        },
        guardarMateriasGrupos: function () {
            const materias = this.materias.map((mat) => ({
                id_materia: mat.id_materia,
                id_grupo: this.id,
                name: mat.name,
                materia: mat.materia,
            }));

            console.log(materias);

            // Función para enviar una petición POST
            const enviarPeticion = async (materia) => {
                try {
                    const response = await axios.post(apimatG, materia);
                    console.log("Respuesta del servidor:", response.data);
                } catch (error) {
                    console.error("Error al enviar la petición:", error);
                }
            };

            // Enviar una petición por cada objeto en el arreglo
            materias.forEach((materia) => {
                enviarPeticion(materia);
            });
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiAsignacion");
