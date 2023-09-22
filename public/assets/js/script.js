function checkFile() {
    const fileInput = $("#formFileLaporan")[0];
    const uploadMessage = $("#uploadMessage");

    if (fileInput.files.length > 0) {
        const fileSize = fileInput.files[0].size;
        const maxSize = 5 * 1024 * 1024;

        uploadMessage.toggle(fileSize > maxSize);
        uploadMessage.text(
            fileSize > maxSize
                ? "File terlalu besar. Ukuran maksimum adalah 5 MB."
                : "Upload file"
        );
    } else {
        uploadMessage.show();
        uploadMessage.text("Upload file");
    }
}

function checkFoto() {
    const fileInput = $("#formFileFoto")[0];
    const uploadMessage = $("#fotoMessage");

    if (fileInput.files.length > 0) {
        const fileSize = fileInput.files[0].size;
        const maxSize = 5 * 1024 * 1024;

        uploadMessage.toggle(fileSize > maxSize);
        uploadMessage.text(
            fileSize > maxSize
                ? "Foto terlalu besar. Ukuran maksimum adalah 5 MB."
                : "Upload Foto"
        );
    } else {
        uploadMessage.show();
        uploadMessage.text("Upload Foto");
    }
}

$("#mySelect1").select2({
    dropdownParent: $("#TambahData"),
});
$("#mySelect2").select2({
    dropdownParent: $("#TambahData"),
});
$("#EditmySelect1").select2({
    dropdownParent: $("#EditData"),
});
$("#EditmySelect2").select2({
    dropdownParent: $("#EditData"),
});

$("#id_kcd").select2({
    dropdownParent: $("#TambahData"),
});
$("#id_kab").select2({
    dropdownParent: $("#TambahData"),
});
$("#npsn_sekolah").select2({
    dropdownParent: $("#TambahData"),
});

$("#id_kcd_edit").select2({
    dropdownParent: $("#EditData"),
});
$("#id_kab_edit").select2({
    dropdownParent: $("#EditData"),
});
$("#npsn_sekolah_edit").select2({
    dropdownParent: $("#EditData"),
});

// upload file
jQuery(function ($) {
    $("#files").shieldUpload();
});

function login() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-start",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        title: "Login Success!",
    });
}
function addData() {
    Swal.fire("Success", "Kamu berhasi menambah data baru!", "success");
}
function editData() {
    Swal.fire("Success", "Kamu berhasil merubah data!", "success");
}
function deleteData() {
    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Kamu yakin untuk menghapus data ini",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Hapus!", "Kamu berhasil menghapus data ini.", "success");
        }
    });
}

$(document).ready(function () {
    $("#inputOmset").inputmask({
        alias: "numeric",
        groupSeparator: ",",
        autoGroup: true,
        digits: 0,
        prefix: "Rp ",
        placeholder: "0",
        rightAlign: false,
    });

    $("#inputOmset").on("input", function () {
        $("#rupiah").val(
            $("#inputOmset")
                .val()
                .replace(/Rp|,| /gi, "")
        );
    });

    $("#inputEditOmset").inputmask({
        alias: "numeric",
        groupSeparator: ",",
        autoGroup: true,
        digits: 0,
        prefix: "Rp ",
        placeholder: "0",
        rightAlign: false,
    });

    $("#inputEditOmset").on("input", function () {
        $("#rupiahEdit").val(
            $("#inputEditOmset")
                .val()
                .replace(/Rp|,| /gi, "")
        );
    });
});
$(function () {
    // tambah data di Sekolah
    $("#submit").prop("disabled", true);
    $("#inputNISN").on("input", function (e) {
        if (this.value.length === 10) {
            $("#inputNISN").removeClass("is-invalid");
            $("#submit").prop("disabled", false);
            $("#alertNISN").empty();
        } else {
            $("#inputNISN").addClass("is-invalid");
            $("#submit").prop("disabled", true);
            $("#alertNISN").html("Minimal 10 karakter");
        }
    });
    $("#submit").prop("disabled", true);
    $("#inputNoHp").on("input", function (e) {
        // console.log(this.value.length);
        if (this.value.length >= 11 && this.value.length <= 13) {
            $("#inputNoHp").removeClass("is-invalid");
            $("#submit").prop("disabled", false);
            $("#alertNoHp").empty();
        } else {
            $("#inputNoHp").addClass("is-invalid");
            $("#submit").prop("disabled", true);
            $("#alertNoHp").html("Minimal 12 karakter");
        }
    });
    // edit data di Sekolah
    $("#submitEdit").prop("disabled", true);
    $("#inputEditNoHp").on("input", function (e) {
        if (
            this.value.length >= 11 &&
            this.value.length <= 13 &&
            this.value.trim().length !== 0
        ) {
            $("#inputEditNoHp").removeClass("is-invalid");
            $("#submitEdit").prop("disabled", false);
            $("#alertEditNoHp").empty();
        } else {
            $("#inputEditNoHp").addClass("is-invalid");
            $("#submitEdit").prop("disabled", true);
            $("#alertEditNoHp").html("Minimal 12 karakter");
        }
    });
});
