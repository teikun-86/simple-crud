function ajaxPost(el, url, modal = null, reload = null) {
    var data = $(`#${el}`).serialize()
    $.ajax({
        type: "POST",
        data: data,
        url: url,
        success: function(res) {
            notify(res.message)
            if(modal != null) {
                $(`#${modal}`).modal('hide')
            }
            if(reload != null) {
                $(reload).DataTable().ajax.reload()
            }
        }
    })
}

function createSiswaModal(id) {
    var idprefix = 'modal-create-siswa-' + id
    if(!document.querySelector(`#${idprefix}`)){
        $('body').append(`<div class="modal fade" id="${idprefix}" tabindex="-1" aria-labelledby="${idprefix}Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="${idprefix}Label">Create new Siswa</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form id="formFor${idprefix}" action="/admin/siswa-create" method="post" onsubmit="event.preventDefault(); ajaxPost('formFor${idprefix}', '/admin/siswa-create', '${idprefix}', '#siswaList');">${getSiswaFields(idprefix)}<div class="float-right"><span class="btn btn-light mr-2" data-dismiss="modal">Close</span><button type="submit" class="btn btn-primary">Submit</button></div></form></div></div></div></div>
        `)
        getJurusans(`#${idprefix}jurusan_id`)
    }
    $(`#${idprefix}`).modal('show')
}

function modalEditSiswa(id, data) {
    siswa = JSON.parse(data)
    idprefix = "modal-edit-siswa-id-"+id;
    if(!document.querySelector(`#${idprefix}`)) {
        $('body').append(`
            <div class="modal fade" id="${idprefix}" tabindex="-1" aria-labelledby="${idprefix}Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="${idprefix}Label">Update Siswa</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form id="formFor${idprefix}" action="/admin/siswa-update" method="post" onsubmit="event.preventDefault(); ajaxPost('formFor${idprefix}', '/admin/siswa-update/${id}', '${idprefix}', '#siswaList');">${getSiswaFields(idprefix, siswa)}<div class="float-right"><span class="btn btn-light mr-2" data-dismiss="modal">Close</span><button type="submit" class="btn btn-primary">Submit</button></div></form></div></div></div></div>
        `)
        getJurusans(`#${idprefix}jurusan_id`, siswa.jurusan_id)
    }
    $(`#${idprefix}`).modal('show')
}

function modalDeleteSiswa(id) {
    idprefix = "modal-delete-siswa-id-"+id
    csrf = $('meta[name="csrf-token"]').attr('content')
    if(!document.querySelector(`#${idprefix}`)) {
        $('body').append(`
            <div class="modal fade" id="${idprefix}" tabindex="-1" aria-labelledby="${idprefix}Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title" id="${idprefix}Label">Hapus Siswa</h5><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p>Yakin ingin menghapus data siswa?</p><form id="formFor${idprefix}" action="/admin/siswa-delete/" method="post" onsubmit="event.preventDefault(); ajaxPost('formFor${idprefix}', '/admin/siswa-delete', '${idprefix}', '#siswaList');"><input type="hidden" name="_token" value="${csrf}"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="ids[]" value="${id}"><div class="float-right"><span class="btn btn-light mr-2" data-dismiss="modal">Close</span><button type="submit" class="btn btn-danger">Hapus</button></div></form></div></div></div></div>
        `)
    }
    $(`#${idprefix}`).modal('show')
}

function createJurusanModal(id) {
    var idprefix = 'modal-create-jurusan-'+id
    csrf = $('meta[name="csrf-token"]').attr('content')
    if(!document.querySelector(`#${idprefix}`)) {
        $('body').append(`<div class="modal fade" id="${idprefix}" tabindex="-1" aria-labelledby="${idprefix}Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="${idprefix}Label">Create new Jurusan</h5><button type="button" class="close"data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form id="formFor${idprefix}" action="/admin/jurusan-create" method="post"onsubmit="event.preventDefault(); ajaxPost('formFor${idprefix}', '/admin/jurusan-create', '${idprefix}', '#jurusanList');"><input type="hidden" name="_token" value="${csrf}"><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}name">Nama Jurusan</label></div><div class="col-md-8"><input type="text" name="name" id="${idprefix}name" class="form-control form-control-sm" required></div></div><div class="float-right"><span class="btn btn-light mr-2"data-dismiss="modal">Close</span><button type="submit"class="btn btn-primary">Submit</button></div></form></div></div></div></div>
        `)
    }
    $(`#${idprefix}`).modal('show')
}

function modalEditJurusan(id, data) {
    var jurusan = JSON.parse(data)
    idprefix = 'modal-edit-jurusan-id-' + id
    csrf = $('meta[name="csrf-token"]').attr('content')
    if(!document.querySelector(`#${idprefix}`)) {
        $('body').append(`<div class="modal fade" id="${idprefix}" tabindex="-1" aria-labelledby="${idprefix}Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="${idprefix}Label">Edit Jurusan</h5><button type="button" class="close"data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form id="formFor${idprefix}" action="/admin/jurusan-update/${id}" method="post"onsubmit="event.preventDefault(); ajaxPost('formFor${idprefix}', '/admin/jurusan-update/${id}', '${idprefix}', '#jurusanList');"><input type="hidden" name="_token" value="${csrf}"><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}name">Nama Jurusan</label></div><div class="col-md-8"><input type="text" name="name" id="${idprefix}name" value="${jurusan.name}" class="form-control form-control-sm" required></div></div><div class="float-right"><span class="btn btn-light mr-2"data-dismiss="modal">Close</span><button type="submit"class="btn btn-primary">Submit</button></div></form></div></div></div></div>
        `)
    }
    $(`#${idprefix}`).modal('show')
}

function modalDeleteJurusan(id) {
    idprefix = "modal-delete-jurusan-id-"+id
    csrf = $('meta[name="csrf-token"]').attr('content')
    if(!document.querySelector(`#${idprefix}`)) {
        $('body').append(`
            <div class="modal fade" id="${idprefix}" tabindex="-1" aria-labelledby="${idprefix}Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title" id="${idprefix}Label">Hapus Jurusan</h5><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p>Yakin ingin menghapus data jurusan?</p><form id="formFor${idprefix}" action="/admin/jurusan-delete/" method="post" onsubmit="event.preventDefault(); ajaxPost('formFor${idprefix}', '/admin/jurusan-delete', '${idprefix}', '#jurusanList');"><input type="hidden" name="_token" value="${csrf}"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="ids[]" value="${id}"><div class="float-right"><span class="btn btn-light mr-2" data-dismiss="modal">Close</span><button type="submit" class="btn btn-danger">Hapus</button></div></form></div></div></div></div>
        `)
    }
    $(`#${idprefix}`).modal('show')
}

function getSiswaFields(idprefix = null, data = null) {
    var csrf = $('meta[name="csrf-token"]').attr('content')
    return `<input type="hidden" name="_token" value="${csrf}"><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}name">Nama</label></div><div class="col-md-8"><input type="text" name="name" id="${idprefix}name" class="form-control form-control-sm" value="${data ? data.name : ''}" required></div></div><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}nisn">NISN</label></div><div class="col-md-8"><input type="number" name="nisn" id="${idprefix}nisn" class="form-control form-control-sm" value="${data ? data.nisn : ''}" required></div></div><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}jurusan_id">Jurusan</label></div><div class="col-md-8"><select name="jurusan_id" id="${idprefix}jurusan_id" class="form-control form-control-sm" required></select></div></div><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}birth_place">Tempat Lahir</label></div><div class="col-md-8"><input type="text" name="birth_place" id="${idprefix}birth_place" class="form-control form-control-sm" value="${data ? data.birth_place : ''}" required></div></div><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}birth_date">Tanggal Lahir</label></div><div class="col-md-8"><input type="date" name="birth_date" id="${idprefix}birth_date" class="form-control form-control-sm" value="${data ? data.dob : ''}" required></div></div><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}birth_date">Gender</label></div><div class="col-md-8"><div class="form-check form-check-inline"><input ${data && data.gender === 'male' ? 'checked' : ''} class="form-check-input" type="radio" name="gender" id="${idprefix}gender-male" value="male"><label class="form-check-label" for="${idprefix}gender-male">Laki-laki</label></div><div class="form-check form-check-inline"><input ${data && data.gender === 'female' ? 'checked' : ''} class="form-check-input" type="radio" name="gender" id="${idprefix}gender-female" value="female"><label class="form-check-label" for="${idprefix}gender-female">Perempuan</label></div></div></div><div class="row mb-3"><div class="col-md-4"><label for="${idprefix}address">Alamat</label></div><div class="col-md-8"><textarea name="address" id="${idprefix}address" rows="4" class="form-control form-control-sm" required>${data ? data.address : ''}</textarea></div></div>`;
}

function getJurusans(el, selected = null) {
    $.ajax({
        type: "GET",
        url: "/api/jurusans",
        success: function(resp) {
            resp.jurusans.forEach(jrsn => {
                $(el).append(`<option value="${jrsn.id}" ${selected && selected === jrsn.id ? 'selected' : ''}>${jrsn.name}</option>`)
            })
        }
    })
}

function notify(message, type = 'success') {
    title = type.toUpperCase()
    $('body').append(`
            <div class="toast" style="position: fixed; top: 20px; right: 15px; min-width: 280px;" data-autohide="false" id="toastNotif">
                <div class="toast-header bg-${type} text-white">
                    <strong class="mr-auto">${title}</strong>
                    <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>`);

    $('#toastNotif').toast('show')

    setTimeout(() => {
        $('#toastNotif').toast('hide')
        $('#toastNotif').remove()
    }, 3000);
}