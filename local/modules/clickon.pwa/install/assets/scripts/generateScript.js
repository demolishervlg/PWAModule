function startGenerate() {
    event.preventDefault();
    $.ajax({
        url: '/bitrix/admin/clickon.pwa/generate.php',
        type: "POST",
        success: function(data) {
            event.preventDefault();
            alert("Манифест успешно сгенерирован")
        }
    });
}
