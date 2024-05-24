var ruta = document.querySelector("[name=route]").value;
var getProfe = ruta + "/getMaestro";
var apiDisposicion = ruta + "/apiDisp";
var getDisp = ruta + "/getDisposicion";

const curpValue = document.getElementById("curpInput").value;

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: curpValue,
            principal: 0,
            maestro: [],
            curpConsultaGet: curpValue,
            id_maestro: "",

            martes1: [],
            martes2: [],
            miercoles1: [],
            miercoles2: [],
            jueves1: [],
            jueves2: [],
            sabado1: [],
            sabado2: [],
            sabado3: [],
            sabado4: [],
            sabado5: [],
            sabado6: [],
            domingo1: [],
            domingo2: [],
            domingo3: [],
            //traer Disp
            disp: [],
            //mostrar datos disponibilidad
            mostrar: 0,
        };
    },
    created() {
        this.getMaestro();
        // this.getDisp();
    },

    methods: {
        vista1: function () {
            this.principal = 1;
            this.getDisp();
        },
        vista2: function () {
            this.principal = 2;
            // this.getMaestro();
            this.getDisp();
        },
        getMaestro: function () {
            axios
                .get(getProfe + "/" + curpValue)
                .then((response) => {
                    this.maestro = response.data;
                    this.id_maestro = response.data.id_profe;
                    // console.log(this.id_maestro);
                })
                .catch((error) => {
                    // console.error("Error al obtener el maestro:", error);
                });
        },
        importarUsuarios: function () {
            const formData = new FormData();
            formData.append("file", this.$refs.fileInput.files[0]);

            axios
                .post("/importar-usuarios", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    alert("Usuarios importados exitosamente.");
                })
                .catch((error) => {
                    console.error("Error al importar usuarios:", error);
                    alert("Hubo un error al importar usuarios.");
                });
        },
        guardarDisposicion: function () {
            const horarios = {
                martes1: this.martes1[0],
                martes2: this.martes2[0],
                miercoles1: this.miercoles1[0],
                miercoles2: this.miercoles2[0],
                jueves1: this.jueves1[0],
                jueves2: this.jueves2[0],
                sabado1: this.sabado1[0],
                sabado2: this.sabado2[0],
                sabado3: this.sabado3[0],
                sabado4: this.sabado4[0],
                sabado5: this.sabado5[0],
                sabado6: this.sabado6[0],
                domingo1: this.domingo1[0],
                domingo2: this.domingo2[0],
                domingo3: this.domingo3[0],
            };

            Object.values(horarios).forEach((value) => {
                // alert(value);
                if (value != null) {
                    // console.log(value)

                    const disp = {
                        id_profesor: this.maestro.id_profe,
                        id_horario: value,
                    };

                    axios
                        .post(apiDisposicion, disp)
                        .then((response) => {
                            // console.log("exito");
                        })
                        .catch((error) => {
                            // console.error("Error submitting form:", error);
                        });
                    

                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Datos guardados",
                        showConfirmButton: false,
                        timer: 1500,
                    });

                } else {
                    // console.log("existe un error en array horarios" + value);
                }
            });
            location.reload();
        },
        getDisp: function () {
            // console.log(this.id_maestro);
            axios
                .get(getDisp + "/" + this.id_maestro)
                .then((response) => {
                    this.disp = response.data;
                    if (this.disp.length >= 0) {
                        //esta variable permite saber si se cuenta o no con una disposicion planteada
                        this.mostrar = 1;
                    }
                    // console.log(this.disp);
                    // console.log(this.id_maestro);
                })
                .catch((error) => {
                    // console.error("Error al obtener el maestro:", error);
                });
        },
        eliminarDisp: function () {
            // alert('eliminar dispo')
            this.disp.forEach((element) => {
                // console.log(element.id_disp);
                axios.delete(apiDisposicion + '/'+ element.id_disp)
                .then(response => {
                    console.log(response.data.message);
                    // Aquí puedes emitir un evento o actualizar la lista de elementos
                    location.reload();
                })
                .catch(error => {
                    console.error(error.response.data.message);
                });
            });
            
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiProfes");
