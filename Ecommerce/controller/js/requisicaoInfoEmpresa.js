
$(document).ready(function () {
    console.log('Antes da requisição AJAX');

    $.ajax({
        url: 'http://localhost/LPWEB/Ecommerce/model/php/classeInformacoesEmpresa.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log('Sucesso na requisição AJAX');
            console.log(data);

            if (data) {
                $('#sobre').text(data.sobre);
                $('#missao').text(data.missao);
                $('#visao').text(data.visao);
                $('#valores').text(data.valores);
            } else {
                $('#sobre').text('Não foi possível carregar as informações da empresa.');
            }
        },
        error: function (xhr, status, error) {
            console.log('Erro na requisição AJAX');
            console.log(xhr.responseText);

            $('#sobre').text('Erro ao carregar informações da empresa.');
        }
    });
});
