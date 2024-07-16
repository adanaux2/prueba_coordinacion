var ruta = document.querySelector("[name=route]").value;

var apiMaterias = ruta + "/apiMaterias";
var apiR = ruta + "/apiR";
var importar = ruta + "/importar";
var importar2 = ruta + "/import";

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: "apiMaterias desde vue 3",
            materias: [],
            rObtenidas: [],
            nMateria: "",
            cuatrimestre: "",
            licenciatura: "",
            id_rvoe: "",
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
            window.axios.get(apiR).then((response) => {
                // console.log(response.data);
                this.rObtenidas = response.data;
                // console.log(this.licenciaturasObtenidas);
            });
            // .catch((error) => {
            //     console.error("Hubo un error al obtener los datos:", error);
            // });
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
                        title: "Asignaturas registradas",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                })
                .catch((error) => {
                    console.error("Error submitting form:", error);
                });
            $(exampleModal).modal("hide");
        },
        importarUsuarios: function () {
           
            const formData = new FormData();
            formData.append("file", this.$refs.fileInput.files[0]);
            formData.append("id_rvoe", this.id_rvoe); // Agregar id_rvoe al FormData

            axios
                .post(importar2, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    // alert("Usuarios importados exitosamente.");
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Usuarios importados exitosamente.",
                        showConfirmButton: false,
                        timer: 1500
                      });
                })
                .catch((error) => {
                    console.error("Error al importar usuarios:", error);
                    // alert("No se pudieron importar los usuarios.");
                    
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No se pudieron importar los usuarios. Asegurate de que el archivo se encuentra en el formato correcto.",
                      });
                });
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiMaterias");
