var procesosInsertarProducto = {
    initInsertarUsario: function() {
        this.ListarUsuarios()
    },

    ListarUsuarios: function() {
        var self = this
        var table = $("#ListarUsuarios").DataTable({
            "aProcessing": true,
            "aServerSide": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            "ajax": {
                "url": "../Controllers/usurios/usuarios.php?case=ListarUsuarios",
                "dataSrc": ""
            },
            "columns":[
            {"data":"#"},
            {"data":"nombre"},
            {"data":"telefono"},
            {"data":"imagen"},
            {"data":"status"},
            {"data":"options"}
        ],
            "initComplete": function() {
                procesosInsertarProducto.CrearUsuarios(table)

            },
            "resonsieve": "true",
            "bDestroy": true,
            "iDisplayLength": 10,
            "order": [
                [0, "asc"]
            ]
        });
        table.on('draw', function() {
            $(".btnDelUsuario").on('click', function() {
                var id = $(this).attr('data-control');
                self.EliminarUsuario(table, id)
            })
        });
    },

    EliminarUsuario: function(table, id = '') {
        if (id != '') {
            event.preventDefault()
            swal({
                title: "¿Estás seguro?",
                html: "¡No podrás recversar esta operación!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#24b145',
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText: "Cancelar",
                allowOutsideClick: false
            }).then(function() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "../Controllers/usurios/usuarios.php",
                    data: { "case": 'eliminarUsuario', "id": id },
                    success: function(response, xhr, settings) {
                        if (response.status == 1) {
                            table.ajax.reload(function() {
                                procesosInsertarProducto.EliminarUsuario(table);
                            });
                            swal({
                                title: response.titulo,
                                html: response.msg,
                                type: "success",
                                confirmButtonText: "Ok!",
                                confirmButtonColor: "#24b145"
                            })
                        } else {
                            swal({
                                title: response.titulo,
                                html: response.msg,
                                type: "error",
                                confirmButtonText: "Ok!",
                                confirmButtonColor: "#24b145"
                            })
                        }
                    },
                    error: function() {
                        swal({
                            title: "Oops...",
                            text: "Error al Eliminar el usuario, si el error sigue comuniquese con soporte.",
                            type: "error",
                            confirmButtonText: "Ok!",
                            closeOnConfirm: false
                        })
                    }
                });
            });
        }
    },

    CrearUsuarios: function(table) {
        var self = this
        $("form[name=FormCrearUsuario]").submit(function(e) {
            e.preventDefault()
            var formData = new FormData(document.getElementById("FormCrearUsuario"));

            $.ajax({
                processData: false,
                contentType: false,
                type: "POST",
                dataType: "json",
                url: "../Controllers/usurios/usuarios.php",
                data: formData,
                success: function(response, xhr, settings) {
                    if (response.status == 1) {

                        table.ajax.reload(function() {
                            procesosInsertarProducto.EliminarUsuario(table);
                        });
                        swal({
                            title: response.titulo,
                            html: response.msg,
                            type: "success",
                            confirmButtonText: "Ok!",
                            confirmButtonColor: "#24b145"
                        })
                        document.getElementById("FormCrearUsuario").reset()
                    } else {
                        swal({
                            title: response.titulo,
                            text: response.msg,
                            type: "info",
                            confirmButtonText: "Ok!",
                            closeOnConfirm: false
                        })
                    }
                },
                error: function() {
                    swal({
                        title: "¡Error!",
                        text: "Error al crear usuario, si el error sigue comuniquese con soporte.",
                        type: "error",
                        confirmButtonText: "Ok!",
                        closeOnConfirm: false
                    })
                    document.getElementById("FormCrearUsuario").reset()
                }
            })
            return false;

        });
    }
}

var procesosEditarUsuario = {
    initEditarUsario: function() {
        this.EditarUsario()
    },

    EditarUsario: function() {
        var self = this
        $("form[name=FormEditarUsuario]").submit(function(e) {

            e.preventDefault()
            var formData = new FormData(document.getElementById("FormEditarUsuario"));

            $.ajax({
                processData: false,
                contentType: false,
                type: "POST",
                dataType: "json",
                url: "../Controllers/usurios/usuarios.php",
                data: formData,
                success: function(response, xhr, settings) {
                    if (response.status == 1) {

                        swal({
                            title: response.titulo,
                            html: response.texto,
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<i class="fa fa-group"></i> ' + "Volver",
                            cancelButtonText: '<i class="fa fa-pencil-square-o"></i> ' + "Ok!",
                            allowOutsideClick: false
                        }).then(function() {
                            window.location = 'usuarios';
                        }, function(dismiss) {
                            //Cancel
                        })
                    } else {
                        swal({
                            title: response.titulo,
                            text: response.texto,
                            type: "info",
                            confirmButtonText: "Ok!",
                            closeOnConfirm: false
                        })
                    }
                },
                error: function() {
                    swal({
                        title: "Oops...",
                        text: "Error al Editar el usuario, si el error sigue comuniquese con soporte.",
                        type: "error",
                        confirmButtonText: "Ok!",
                        closeOnConfirm: false
                    })
                }
            })
            return false;

        });
    }
}
