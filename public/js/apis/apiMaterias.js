var apiMaterias = "http://localhost/prueba_coordinacion/public/apiMaterias";
var apiLicenciaturas =
    "http://localhost/prueba_coordinacion/public/apiLicenciaturas";

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: "apiMaterias desde vue 3",
            materias: [],
            licenciaturasObtenidas: [],
            nMateria: "",
            cuatrimestre: "",
            licenciatura: "",
        };
    },
    created() {
        this.obtenerMaterias();
        this.obtenerLicenciaturas();
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
            window.axios
                .get(apiLicenciaturas)
                .then((response) => {
                    // console.log(response.data);
                    this.licenciaturasObtenidas = response.data;
                    console.log(this.licenciaturasObtenidas);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        guardarMateria: function () {
            const materia = {
                materia: this.nMateria,
                cuatrimestre: this.cuatrimestre,
                id_licenciatura: this.licenciatura,
            };

            console.log(materia);
            axios
                .post(apiMaterias, materia)
                .then((response) => {
                    // console.log("exito");
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Asignatura registrada",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                })
                .catch((error) => {
                    console.error("Error submitting form:", error);
                });
            $(exampleModal).modal("hide");
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiMaterias");
