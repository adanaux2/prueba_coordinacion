var ruta = document.querySelector("[name=route]").value;
var getProfe = ruta + "/getMaestro";
var apiDisposicion = ruta + "/apiDisp";
var getDisp = ruta + "/getDisposicion";
var LiscMaterias = ruta + "/apiLisc";
var apiMapa = ruta + "/apiMapa";

const curpValue = document.getElementById("curpInput").value;

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: curpValue,
            principal: 0,
            maestro: [],
            lisc: [],
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
            //mostrar datos de mapa curricular guardado
            mostrar2: 0,
            // selected:'',
            MateriasSeleccionadas: [],
            MapaGuardado: [],
        };
    },
    created() {
        this.getMaestro();
        // this.getDisp();
        this.obtenerLisc();
    },
    watch: {
        // selected(newValue) {
        //     console.log(`El valor de selected ha cambiado a: ${newValue}`);
        // }
    },
    methods: {
        vista1: function () {
            this.principal = 1;
            this.getMaestro();
            this.getDisp();
            this.getMapa();
        },
        vista2: function () {
            this.principal = 2;
            // this.getMaestro();
            this.getDisp();
            this.getMapa();
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
            axios.get(getDisp + "/" + this.id_maestro).then((response) => {
                this.disp = response.data;
                if (this.disp.length >= 0) {
                    //esta variable permite saber si se cuenta o no con una disposicion planteada
                    this.mostrar = 1;
                }
                // console.log(response);
                // console.log(this.id_maestro);
            });
            // .catch((error) => {
            //     console.error(response);
            // });
        },
        eliminarDisp: function () {
            // alert('eliminar dispo')
            this.disp.forEach((element) => {
                // console.log(element.id_disp);
                axios
                    .delete(apiDisposicion + "/" + element.id_disp)
                    .then((response) => {
                        console.log(response.data.message);
                        // Aquí puedes emitir un evento o actualizar la lista de elementos
                        location.reload();
                    })
                    .catch((error) => {
                        console.error(error.response.data.message);
                    });
            });
        },
        obtenerLisc: function () {
            window.axios
                .get(LiscMaterias)
                .then((response) => {
                    // console.log(response.data);
                    this.lisc = response.data;
                    console.log(this.lisc);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        saveSelected: function () {
            alert("guardar");
            console.log(this.MateriasSeleccionadas);
            // console.log(this.id_maestro);
            // this.maestro;
            axios
                .post(apiMapa, {
                    materias: this.MateriasSeleccionadas,
                })
                .then((response) => {
                    // console.log("Materias guardadas:", response.data);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Datos guardados",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    location.reload();
                })
                .catch((error) => {
                    console.error("Error al guardar las materias:", error);
                });
        },
        handleCheckboxChange: function (materia) {
            if (materia.selected) {
                // Lógica para enviar los datos de la materia seleccionada
                console.log(materia);
                materia.id_profe = this.id_maestro;
                this.MateriasSeleccionadas.push(materia);
            }
        },
        getMapa: function () {
            axios.get(apiMapa + "/" + this.id_maestro).then((response) => {
                this.MapaGuardado = response.data;
                if (this.MapaGuardado.length >= 0) {
                    //esta variable permite saber si se cuenta o no con una disposicion planteada
                    // this.mostrar = 1;
                    this.mostrar2 = 1;
                    console.log(this.MapaGuardado);
                }
                // console.log(response);
                // console.log(this.id_maestro);
            });
        },
        EliminarMapa: function () {
            Swal.fire({
                title: "Eliminar?",
                text: "Estas seguro de eliminar tu mapa curricular?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log(this.MapaGuardado)
                    this.MapaGuardado.forEach((element) => {
                        // console.log(element.id_mapa);
                        axios
                            .delete(apiMapa + "/" + element.id_mapa)
                            .then((response) => {
                                console.log(response.data.message);
                                
                            })
                            .catch((error) => {
                                console.error(error.response.data.message);
                            });
                    });
                    Swal.fire({
                        title: "Información eliminada!",
                        text: "Tu mapa curricular fue eliminado.",
                        icon: "success",
                    });
                    location.reload();
                }
            });
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiProfes");
