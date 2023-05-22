/* Alternar entre adicionar e remover a classe "responsiva" do topnav quando o usuário clicar no ícone */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

/* Atribui ao evento keypress do input cpf a função para formatar o CPF */
var inputCPF = document.getElementById("cpfProdutor");
if (inputCPF != null && inputCPF.addEventListener) {
  inputCPF.addEventListener("keypress", function () {
    mascaraTexto(this, "###.###.###-##");
  });
} else if (inputCPF != null && inputCPF.attachEvent) {
  inputCPF.attachEvent("onkeypress", function () {
    mascaraTexto(this, "###.###.###-##");
  });
}

/* Atribui ao evento keypress do input cadastroRural a função para formatar o cadastroRural */
var inputCR = document.getElementById("cadastroRural");
if (inputCR != null && inputCR.addEventListener) {
  inputCR.addEventListener("keypress", function () {
    mascaraTexto(this, "###.######/##");
  });
} else if (inputCR != null && inputCR.attachEvent) {
  inputCR.attachEvent("onkeypress", function () {
    mascaraTexto(this, "###.######/##");
  });
}

/* Função para validar os dados antes da submissão dos dados */
function validaCadastro(evt) {
  var cpfProdutor = document.getElementById("cpfProdutor");
  var cadastroRural = document.getElementById("cadastroRural");
  var filtro =
    /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  var contErro = 0;

  if (contErro > 0) {
    evt.preventDefault();
  }
}

/* Função para formatar dados conforme parâmetro enviado, CPF, cadastroRural */
function mascaraTexto(t, mask) {
  var i = t.value.length;
  var saida = mask.substring(1, 0);
  var texto = mask.substring(i);

  if (texto.substring(0, 1) != saida) {
    t.value += texto.substring(0, 1);
  }
}

/* Confirmar antes de deletar os dados */
$('.Deletar').on('click', function(event) {

    event.preventDefault();

    var Link = $(this).attr('href');

    if (confirm("Deseja mesmo apagar esse dado?")) {
        window.location.href = Link;
    } else {
        return false;
    }
});
