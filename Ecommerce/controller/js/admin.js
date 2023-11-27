function mostrarFormulario(idFormulario) {
    // Oculta todos os formulários e exibe o botão Editar
    document.querySelectorAll('.formulario').forEach(function (formulario) {
        formulario.style.display = 'none';
        var botoesConfirmarCancelar = formulario.querySelector('.botoes-confirmar-cancelar');
        if (botoesConfirmarCancelar) {
            botoesConfirmarCancelar.style.display = 'none';
        }
        var botaoEditar = formulario.querySelector('.botao-editar');
        if (botaoEditar) {
            botaoEditar.style.display = 'flex';
        }
    });

    // Mostra apenas o formulário correspondente
    var formulario = document.getElementById(idFormulario);
    formulario.style.display = 'block';
}

function habilitarEdicao(idFormulario) {
    // Exibe os botões Confirmar e Cancelar e oculta o botão Editar
    var formulario = document.getElementById(idFormulario);
    var textareas = formulario.querySelectorAll('textarea');
    textareas.forEach(function (element) {
        element.removeAttribute('readonly');
    });
    var botoesConfirmarCancelar = formulario.querySelector('.botoes-confirmar-cancelar');
    if (botoesConfirmarCancelar) {
        botoesConfirmarCancelar.style.display = 'flex';
    }
    var botaoEditar = formulario.querySelector('.botao-editar');
    if (botaoEditar) {
        botaoEditar.style.display = 'none';
    }

    // Habilita os campos para edição
    formulario.querySelectorAll('input, textarea').forEach(function (element) {
        element.removeAttribute('readonly');
    });
}

function confirmarEdicao(formulario) {
    var sobre = $("#sobre").val();
    var missao = $("#missao").val();
    var visao = $("#visao").val();
    var valores = $("#valores").val();

    var dados = {
        sobre: sobre,
        missao: missao,
        visao: visao,
        valores: valores
    };

    $.ajax({
        type: "POST",
        url: base_url + "model/php/editarPaginaEmpresa.php",
        data: dados,
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                alert("Informações da empresa atualizadas com sucesso!");
                // Adiciona esta linha para voltar para o botão editar
                mostrarFormulario(formulario);
            } else {
                alert("Erro ao atualizar as informações da empresa: " + response.message);
                // Adiciona esta linha para recarregar as informações do banco
                carregarDadosEmpresa();
                // Adiciona esta linha para voltar para o botão editar
                mostrarFormulario(formulario);
            }
        },
        error: function (xhr, status, error) {
            alert("Erro na requisição AJAX: " + status + " - " + error);
            // Adiciona esta linha para recarregar as informações do banco
            carregarDadosEmpresa();
            // Adiciona esta linha para voltar para o botão editar
            mostrarFormulario(formulario);
        }
    });
}

function cancelarEdicao(idFormulario) {
    // Cancela a edição, desabilita os campos e exibe o botão Editar
    var formulario = document.getElementById(idFormulario);
    if (formulario) {
        formulario.querySelectorAll('input, textarea').forEach(function (element) {
            element.setAttribute('readonly', 'readonly');
        });

        var botoesConfirmarCancelar = formulario.querySelector('.botoes-confirmar-cancelar');
        if (botoesConfirmarCancelar) {
            botoesConfirmarCancelar.style.display = 'none';
        }
        var botaoEditar = formulario.querySelector('.botao-editar');
        if (botaoEditar) {
            botaoEditar.style.display = 'flex';
        }

        // Recarrega os dados da empresa ao cancelar a edição
        carregarDadosEmpresa();
    }
}

// Event listener para os botões de editar
document.querySelectorAll('.botao-editar').forEach(function (botao) {
    botao.addEventListener('click', function () {
        var idFormulario = this.getAttribute('data-formulario');
        mostrarFormulario(idFormulario);
        habilitarEdicao(idFormulario);
    });
});

// Event listener para os botões de cancelar
document.querySelectorAll('.botao-cancelar').forEach(function (botao) {
    botao.addEventListener('click', function () {
        var idFormulario = this.getAttribute('data-formulario');
        cancelarEdicao(idFormulario);
    });
});

// Oculta os botões Confirmar e Cancelar ao carregar a página
document.querySelectorAll('.botoes-confirmar-cancelar').forEach(function (botoes) {
    if (botoes) {
        botoes.style.display = 'none';
    }
});

function carregarDadosEmpresa() {
    // Adicione aqui a lógica para carregar os dados da empresa usando AJAX
    $.ajax({
        url: base_url + "model/php/classeInformacoesEmpresa.php",
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data !== null) {
                $('#sobre').val(data.sobre);
                $('#missao').val(data.missao);
                $('#visao').val(data.visao);
                $('#valores').val(data.valores);
            } else {
                // Caso não haja dados, você pode tratar isso aqui
                console.log('Não foi possível carregar os dados da empresa.');
            }
        },
        error: function (xhr, status, error) {
            console.log('Erro na requisição AJAX');
            console.log(xhr.responseText);
            console.log(error);
        }
    });
}

// Execute a função para carregar os dados da empresa quando a página carregar
$(document).ready(function () {
    carregarDadosEmpresa();
});
