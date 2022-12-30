<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Odontologo
                <button type="button" @click="abrirModal('odontologo', 'registrar')" class="btn btn-secondary">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                              <option value="nombre">Nombre</option>
                              <option value="apellido">Apellido</option>
                              <option value="ci">CI</option>
                              <option value="fechanacimiento">Fecha Nacimiento</option>
                              <option value="direccion">Direccion</option>
                              <option value="telefono">Telefono</option>
                              <option value="email">Email</option>
                              <option value="especialidad">Especialista</option>
                              <option value="ruc">Ruc</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarOdontologo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="listarOdontologo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Ci</th>
                            <th>FechaNacimiento</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Especialidad</th>
                            <th>Ruc</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="odontologo in arrayOdontologo" :key="odontologo.id">
                            <td>
                                <button type="button" @click="abrirModal('odontologo', 'actualizar', odontologo)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                            </td>
                            <td v-text="odontologo.nombre"></td>
                            <td v-text="odontologo.apellido"></td>
                            <td v-text="odontologo.ci"></td>
                            <td v-text="odontologo.fechanacimiento"></td>
                            <td v-text="odontologo.direccion"></td>
                            <td v-text="odontologo.telefono"></td>
                            <td v-text="odontologo.email"></td>
                            <td v-text="odontologo.especialidad"></td>
                            <td v-text="odontologo.ruc"></td>
                        </tr>
                        
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del odontologo">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                            <div class="col-md-9">
                                <input type="text" v-model="apellido" class="form-control" placeholder="Apellido del odontologo">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Ci</label>
                            <div class="col-md-9">
                                <input type="text" v-model="ci" class="form-control" placeholder="Enter ci">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="date-input">FechaNacimiento</label>
                            <div class="col-md-9">
                                <input type="date" v-model="fechanacimiento" class="form-control" placeholder="Enter fecha nacimiento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Direccion</label>
                            <div class="col-md-9">
                                <input type="text" v-model="direccion" class="form-control" placeholder="Enter direccion">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Telefono</label>
                            <div class="col-md-9">
                                <input type="number" v-model="telefono" class="form-control" placeholder="Enter telefono">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Email</label>
                            <div class="col-md-9">
                                <input type="email" v-model="email" class="form-control" placeholder="email del odontologo">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Especialidad</label>
                            <div class="col-md-9">
                                <input type="text" v-model="especialidad" class="form-control" placeholder="Enter especialidad">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Ruc</label>
                            <div class="col-md-9">
                                <input type="number" v-model="ruc" class="form-control" placeholder="Ruc del odontologo">
                                
                            </div>
                        </div>
                        <div v-show="errorOdontologo" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjOdontologo" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarOdontologo()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarOdontologo()">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    
</main>
</template>

<script>
import Axios from 'axios';

    export default {
    data() {
        return {
            odontologo_id: 0,
            nombre : '',
            apellido : '',
            ci : '',
            fechanacimiento : '',
            direccion : '',
            telefono : '',
            email : '',
            especialidad : '',
            ruc : '',
            arrayOdontologo : [],
            modal : 0,
            tituloModal : '',
            tipoAccion : 0,
            errorOdontologo : 0,
            errorMostrarMsjOdontologo : [],
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            criterio : 'nombre',
            buscar : ''
        }
    },
    computed:{
        isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
    },
    methods : {
        listarOdontologo (page,buscar,criterio) {
            let me=this;
            var url= '/odontologo?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.arrayOdontologo = respuesta.odontologo.data;
                me.pagination= respuesta.pagination;
            })
            .catch(function(error) {
                console.log(error);
            });
           
        },
        cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarOdontologo(page,buscar,criterio);
            },
        registrarOdontologo(){
            if (this.validarOdontologo()){
                return;
            }

            let me = this;


            axios.post('/odontologo/registrar',{
                'nombre':this.nombre,
                'apellido':this.apellido,
                'ci':this.ci,
                'fechanacimiento':this.fechanacimiento,
                'direccion': this.direccion,
                'telefono': this.telefono,
                'email':this.email,
                'especialidad': this.especialidad,
                'ruc':this.ruc,
            }).then(function(response){
                me.cerrarModal();
                me.listarOdontologo(1,'','nombre');
            }).catch(function (error) {
                console.log(error);
            });
        },
        actualizarOdontologo(){
            if (this.validarOdontologo()){
                return;
            }

            let me = this;


            axios.put('/odontologo/actualizar',{
                'nombre':this.nombre,
                'apellido':this.apellido,
                'ci':this.ci,
                'fechanacimiento':this.fechanacimiento,
                'direccion': this.direccion,
                'telefono': this.telefono,
                'email':this.email,
                'especialidad': this.especialidad,
                'ruc':this.ruc,
                'id': this.odontologo_id
            }).then(function(response){
                me.cerrarModal();
                me.listarOdontologo(1,'','nombre');
            }).catch(function (error) {
                console.log(error);
            });
        },
        desactivarOdontologo(id){
            swal({
                title: 'Esta seguro de desactivar este odontologo?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/odontologo/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarOdontologo(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
        },
        activarOdontologo(id){
            swal({
                title: 'Esta seguro de activar este odontologo?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/odontologo/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarOdontologo(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
        },
        validarOdontologo(){
            this.errorOdontologo =0;
            this.errorMostrarMsjOdontologo =[];

            if (!this.nombre) this.errorMostrarMsjOdontologo.push("El nombre del odontologo no puede estar vacio");
            if (!this.apellido) this.errorMostrarMsjOdontologo.push("El apellido del odontologo no puede estar vacio");
            if (!this.ci) this.errorMostrarMsjOdontologo.push("El ci del odontologo no puede estar vacio");
            if (!this.fechanacimiento) this.errorMostrarMsjOdontologo.push("La fecha de nacimiento del odontologo no puede estar vacio");
            if (!this.direccion) this.errorMostrarMsjOdontologo.push("La direccion del odontologo no puede estar vacio");
            if (!this.telefono) this.errorMostrarMsjOdontologo.push("El telefono del odontologo no puede estar vacio");
            if (!this.email) this.errorMostrarMsjOdontologo.push("El email del odontologo no puede estar vacio");
            if (!this.especialidad) this.errorMostrarMsjOdontologo.push("La especialidad del odontologo no puede estar vacio");
            if (!this.ruc) this.errorMostrarMsjOdontologo.push("El ruc del odontologo no puede estar vacio");
            if (this.errorMostrarMsjOdontologo.length) this.errorOdontologo = 1;
            return this.errorOdontologo;
        },
        cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.nombre = '';
            this.apellido = '';
            this.ci = '';
            this.fechanacimiento = '';
            this.direccion = '';
            this.telefono = '';
            this.email = '';
            this.especialidad = '';
            this.ruc = '';
            this.errorOdontologo=0;
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "odontologo":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.modal = 1;
                            this.tituloModal = 'Registrar odontologo';
                            this.nombre = '';
                            this.apellido = '';
                            this.ci = '';
                            this.fechanacimiento = '';
                            this.direccion = '';
                            this.telefono = '';
                            this.email = '';
                            this.especialidad = '';
                            this.ruc = '';
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            //console.log(data);
                            this.modal=1;
                            this.tituloModal='Actualizar odontologo';
                            this.tipoAccion=2;
                            this.odontologo_id=data['id'];
                            this.nombre = data['nombre'];
                            this.apellido = data['apellido'];
                            this.ci= data['ci'];
                            this.fechanacimiento= data['fechanacimiento'];
                            this.direccion= data['direccion'];
                            this.telefono= data['telefono'];
                            this.email = data['email'];
                            this.especialidad= data['especialidad'];
                            this.ruc = data['ruc'];
                            break;
                        }
                    }
                }    
            }
        }
    },
    mounted() {
        this.listarOdontologo(1,this.buscar,this.criterio);
}
}
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }

    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
