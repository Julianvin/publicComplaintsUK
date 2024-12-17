$(document).ready(function () {
    // Ambil data provinsi saat halaman pertama kali dimuat
    $.ajax({
        url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
        type: "GET",
        success: function (data) {
            // Isi dropdown provinsi
            $("#provinsi").append('<option value="">Pilih</option>'); // Tambahkan option pertama
            data.forEach(function (provinsi) {
                $("#provinsi").append(
                    '<option value="' +
                        provinsi.name +
                        '" data-id="' +
                        provinsi.id +
                        '">' +
                        provinsi.name +
                        "</option>"
                );
            });
        },
    });

    // Ketika provinsi dipilih, ambil data kota berdasarkan provinsi yang dipilih
    $("#provinsi").change(function () {
        var provinsiId = $(this).find(":selected").data("id"); // Ambil id dari data-id
        if (provinsiId) {
            $.ajax({
                url:
                    "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" +
                    provinsiId +
                    ".json",
                type: "GET",
                success: function (data) {
                    // Kosongkan dropdown kota
                    $("#kota")
                        .empty()
                        .append('<option value="">Pilih</option>');
                    // Isi dropdown kota
                    data.forEach(function (kota) {
                        $("#kota").append(
                            '<option value="' +
                                kota.name +
                                '" data-id="' +
                                kota.id +
                                '">' +
                                kota.name +
                                "</option>"
                        );
                    });
                },
            });
        } else {
            $("#kota").empty().append('<option value="">Pilih</option>');
        }
    });

    // Ketika kota dipilih, ambil data kecamatan berdasarkan kota yang dipilih
    $("#kota").change(function () {
        var kotaId = $(this).find(":selected").data("id"); // Ambil id dari data-id
        if (kotaId) {
            $.ajax({
                url:
                    "https://www.emsifa.com/api-wilayah-indonesia/api/districts/" +
                    kotaId +
                    ".json",
                type: "GET",
                success: function (data) {
                    // Kosongkan dropdown kecamatan
                    $("#kecamatan")
                        .empty()
                        .append('<option value="">Pilih</option>');
                    // Isi dropdown kecamatan
                    data.forEach(function (kecamatan) {
                        $("#kecamatan").append(
                            '<option value="' +
                                kecamatan.name +
                                '" data-id="' +
                                kecamatan.id +
                                '">' +
                                kecamatan.name +
                                "</option>"
                        );
                    });
                },
            });
        } else {
            $("#kecamatan").empty().append('<option value="">Pilih</option>');
        }
    });

    // Ketika kecamatan dipilih, ambil data kelurahan berdasarkan kecamatan yang dipilih
    $("#kecamatan").change(function () {
        var kecamatanId = $(this).find(":selected").data("id"); // Ambil id dari data-id
        if (kecamatanId) {
            $.ajax({
                url:
                    "https://www.emsifa.com/api-wilayah-indonesia/api/villages/" +
                    kecamatanId +
                    ".json",
                type: "GET",
                success: function (data) {
                    // Kosongkan dropdown kelurahan
                    $("#kelurahan")
                        .empty()
                        .append('<option value="">Pilih</option>');
                    // Isi dropdown kelurahan
                    data.forEach(function (kelurahan) {
                        $("#kelurahan").append(
                            '<option value="' +
                                kelurahan.name +
                                '" data-id="' +
                                kelurahan.id +
                                '">' +
                                kelurahan.name +
                                "</option>"
                        );
                    });
                },
            });
        } else {
            $("#kelurahan").empty().append('<option value="">Pilih</option>');
        }
    });
});
    